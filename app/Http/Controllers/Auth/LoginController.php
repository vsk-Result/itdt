<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employees\Employee;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Adldap\Laravel\Facades\Adldap;

class LoginController extends Controller
{
    use AuthenticatesUsers;

<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
    protected $redirectTo = '/';

    private const MATCH_NAMES = [
        'Влад' => 'Владислав',
        'Вова' => 'Владимир',
        'Слава' => 'Вячеслав',
        'Стас' => 'Станислав',
        'Валера' => 'Валерий',
        'Дима' => 'Дмитрий',
        'Таня' => 'Татьяна',
        'Толя' => 'Анатолий',
        'Настя' => 'Анастасия',
        'Рита' => 'Маргарита',
        'Серега' => 'Сергей',
        'Вася' => 'Василий',
        'Витя' => 'Виктор',
        'Надя' => 'Надежда',
        'Лена' => 'Елена',
        'Саша' => 'Александр',
        'Леша' => 'Алексей',
        'Варя' => 'Варвара',
        'Вика' => 'Виктория',
        'Галя' => 'Галина',
        'Даша' => 'Дарья',
        'Маша' => 'Мария',
        'Катя' => 'Екатерина',
        'Женя' => 'Евгений',
        'Ваня' => 'Иван',
        'Ира' => 'Ирина',
        'Ксюша' => 'Ксения',
        'Лида' => 'Лидия',
        'Макс' => 'Максим',
        'Миша' => 'Михаил',
        'Наташа' => 'Наталья',
        'Оля' => 'Ольга',
        'Паша' => 'Павел',
        'Рома' => 'Роман',
        'Света' => 'Светлана',
        'Юля' => 'Юлия',
    ];

=======
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
>>>>>>> Привел роуты в порядок. Оформил правильно через сервис провайдер (#29)
=======
    protected $redirectTo = '/';

    private const MATCH_NAMES = [
        'Влад' => 'Владислав',
        'Вова' => 'Владимир',
        'Слава' => 'Вячеслав',
        'Стас' => 'Станислав',
        'Валера' => 'Валерий',
        'Дима' => 'Дмитрий',
        'Таня' => 'Татьяна',
        'Толя' => 'Анатолий',
        'Настя' => 'Анастасия',
        'Рита' => 'Маргарита',
        'Серега' => 'Сергей',
        'Вася' => 'Василий',
        'Витя' => 'Виктор',
        'Надя' => 'Надежда',
        'Лена' => 'Елена',
        'Саша' => 'Александр',
        'Леша' => 'Алексей',
        'Варя' => 'Варвара',
        'Вика' => 'Виктория',
        'Галя' => 'Галина',
        'Даша' => 'Дарья',
        'Маша' => 'Мария',
        'Катя' => 'Екатерина',
        'Женя' => 'Евгений',
        'Ваня' => 'Иван',
        'Ира' => 'Ирина',
        'Ксюша' => 'Ксения',
        'Лида' => 'Лидия',
        'Макс' => 'Максим',
        'Миша' => 'Михаил',
        'Наташа' => 'Наталья',
        'Оля' => 'Ольга',
        'Паша' => 'Павел',
        'Рома' => 'Роман',
        'Света' => 'Светлана',
        'Юля' => 'Юлия',
    ];

>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $username = $credentials[$this->username()];
        $password = $credentials['password'];

        if(Adldap::auth()->attempt($username, $password, true)) {
            $user = User::where($this->username(), $username)->first();
            if (!$user) {
                $user = new User();
                $user->username = $username;
                $user->password = \Hash::make($password);

                $sync_attrs = $this->retrieveSyncAttributes($username);
                foreach ($sync_attrs as $field => $value) {
                    $user->$field = $value !== null ? $value : '';
                }

                $user->save();
            }

            $this->guard()->login($user, true);
            return true;
        }

        return false;
    }

    protected function retrieveSyncAttributes($username)
    {
        $ldapuser = Adldap::search()->where('samaccountname', '=', $username)->first();
        if ( !$ldapuser ) {
            return false;
        }

        $ldapuser_attrs = null;
        $attrs = [];

        foreach (config('ldap_auth.sync_attributes') as $local_attr => $ldap_attr) {
            if ( $local_attr == $this->username() ) {
                continue;
            }

            $method = 'get' . $ldap_attr;
            if (method_exists($ldapuser, $method)) {
                $attrs[$local_attr] = $ldapuser->$method();
                continue;
            }

            if ($ldapuser_attrs === null) {
                $ldapuser_attrs = self::accessProtected($ldapuser, 'attributes');
            }

            if (!isset($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = null;
                continue;
            }

            if (!is_array($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr];
            }

            if (count($ldapuser_attrs[$ldap_attr]) == 0) {
                $attrs[$local_attr] = null;
                continue;
            }

            $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr][0];
        }

        return $attrs;
    }

    protected static function accessProtected($obj, $prop)
    {
        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }

    public function authenticated(Request $request, User $user) {
        $name = $user->name;
        $name_arr = explode(' ', $name);
        if (!$user->employee && count($name_arr) > 1) {
            $fullname = $name_arr[1] . ' ' . $name_arr[0];
            $employee = Employee::where('fullname', $fullname)->first();
            if (!$employee) {
                if (key_exists($name_arr[0], self::MATCH_NAMES)) {
                    $fullname = $name_arr[1] . ' ' . self::MATCH_NAMES[$name_arr[0]];
                    $employee = Employee::where('fullname', $fullname)->first();
                    if (!$employee) {
                        $employee = new Employee();
                        $employee->fullname = $fullname;
                        $employee->save();
                    }
                } else {
                    $employee = new Employee();
                    $employee->fullname = $fullname;
                    $employee->save();
                }
            }
            $user->employee_id = $employee->id;
            $user->update();
        }

        return redirect()->intended($this->redirectPath());
    }

    private function isNameCorrect($name)
    {
        return !preg_match("/[^а-яё ]/iu", $name);
    }
}
