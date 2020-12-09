<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Customer;
use App\Owner;
use App\Property;
use App\Rent;
use App\Transfer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {

        if (Auth::check() === true) {
            return redirect()->route('admin.home');
        }

        return view('admin.index');
    }

    public function home()
    {
        $owners = Owner::all()->count();
        $customers = Customer::all()->count();

        $rents = Rent::where('status', 'unpaid')->orderBy('due_at', 'ASC')->limit(10)->get();
        $transfers = Transfer::where('status', 'unpaid')->orderBy('enrollment', 'ASC')->limit(10)->get();

        $propertiesAvailable = Property::available()->count();
        $propertiesUnavailable = Property::unavailable()->count();
        $propertiesTotal = Property::all()->count();


        $propertiesTotal = Property::all()->count();
        $contractsTotal = Contract::all()->count();
        $contracts = Contract::orderBy('id', 'DESC')->limit(10)->get();

        return view('admin.dashboard', [
            'owners' => $owners,
            'customers' => $customers,
            'propertiesAvailable' => $propertiesAvailable,
            'propertiesUnavailable' => $propertiesUnavailable,
            'propertiesTotal' => $propertiesTotal,
            'contractsTotal' => $contractsTotal,
            'contracts' => $contracts,
            'rents' => $rents,
            'transfers' => $transfers

        ]);
    }

    public function login(Request $request)
    {
        if (in_array ('', $request->only('email', 'password'))) {
            $json['message'] = $this->message->error('Ooops, informe todos os dados para efetuar o login')->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Ooops, informe um e-mail válido')->render();
            return response()->json($json);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            $json['message'] = $this->message->error('Ooops, usuário e senha não conferem')->render();
            return response()->json($json);
        }

        $this->authenticated($request->getClientIp());
        $json['redirect'] = route('admin.home');
        return response()->json($json);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    private function authenticated(string $ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
        ]);
    }
}
