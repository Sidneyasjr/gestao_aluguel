<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Customer;
use App\Owner;
use App\Property;
use App\Rent;
use App\Transfer;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AuthController
 * @package App\Http\Controllers\Admin
 */
class AuthController extends Controller
{
    /**
     * @return Application|Factory|RedirectResponse|View
     */
    public function showLoginForm()
    {

        if (Auth::check() === true) {
            return redirect()->route('admin.home');
        }

        return view('admin.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function home()
    {
        $owners = Owner::all()->count();
        $customers = Customer::all()->count();

        $rents = Rent::where('status', 'unpaid')->orderBy('due_at', 'ASC')->limit(10)->get();
        $transfers = Transfer::where('status', 'unpaid')->orderBy('enrollment', 'ASC')->limit(10)->get();

        $rentsUnpaid = Rent::where('status', 'unpaid')->sum('value');
        $rentsUnpaid = number_format($rentsUnpaid, 2, ',', '.');

        $transferUnpaid = Transfer::where('status', 'unpaid')->sum('value');
        $transferUnpaid = number_format($transferUnpaid, 2, ',', '.');


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
            'transfers' => $transfers,
            'rentsUnpaid' => $rentsUnpaid,
            'transferUnpaid' => $transferUnpaid

        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
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

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    /**
     * @param string $ip
     */
    private function authenticated(string $ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip,
        ]);
    }
}
