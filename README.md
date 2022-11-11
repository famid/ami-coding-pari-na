```
Requirements:
-------------
1. PHP >= 7.2.5 and also php extension
2. composer
3. Mysql

```

```
Installation:
--------------
1. Lets go to the directory where you want to keep your project.

2. Then run the below command from the terminal:
$ git clone "https://github.com/famid/ami-coding-pari-na.git"

3. create a .env file and copy from .env.example then set these variables .
 
 APP_NAME,
 DB_DATABASE,
 DB_USERNAME,
 DB_PASSWORD,
 
4. Then run:
$ composer install

5. Lastly, run a few commands:

$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan passport:install

6. To run the application locally, run:

$ php artisan serve

7. For login, use the below credentials:
email: testuser1@gmail.com
password: 12345678
```
```
 Local Url: http://localhost:8000
 Remote Url: http://amicodingparina.ahsanulhoquefamid.xyz
```
[Project Url: http://amicodingparina.ahsanulhoquefamid.xyz](http://amicodingparina.ahsanulhoquefamid.xyz).


### User Authentication/Registration Page
```
Registration:

url: /sign-in
Using Fields: first name, last name, username, email, password

Login:

url: /sign-up
Using Fields: email, password

Constrains:
    Email validation is not added.
    For Production, email validation need to be added.

```

'''
### Khoj the search
```
 url = /khoj-the-search
 
 source path: Ami-Coding-Pari-Na/public/assets/js/script.js
 
 work-flow:
 1. Take the input vlaues
 2. Filter the input values(for other char, or space) using js filter function.
 3. Sort the inputs values using js sort function.
 4. search the value in input values using binary search.
 5 At a consequence time  search the value int input values (at front-end)
   and store data using ajax (at back-end)
 6. Then after getting success response from backend show the result to user.
 
 Note: 
 The time complexity of merge sort is O(n log n)
 lower bound of merge O(n log n)
 The time complexity of Timsort O(n log(n))
 Lower bound of of Timsort is O(n)
 That's why I use js built in sort function.
 
 As we have to sort our inputs, I use binary serch.
 The time compexity of binary search O(log(n))
 
```
### API Endpoints:
 
 [API DOCUMENTATION](https://documenter.getpostman.com/view/11215347/2s8YepsYfS).
```
base url (local) = http://127.0.0.1:8000/api/v1
base url(remote) = http://amicodingparina.ahsanulhoquefamid.xyz/api/v1

ex: http://amicodingparina.ahsanulhoquefamid.xyz/api/v1/user/sign-in
```





### Project conding pattern.



- **[Request](#)**
```
    How to make request class for validation?
    
    For Api: php artisan make:request Api/TestRequest
    For Web: php artisan make:request Web/TestRequest
    
    Example code:
    
    public function rules(): array {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
             ......
        ];
    }
    
    /**
     * @return array
     */
    public function messages(): array {
        return [
            'email.required' => __('Email field can not be empty'),
            'email.email' => __('Invalid email address'),
            'password.required' => __('Password field can not be empty'),
            'password.min' => __('Password length must be at least 8 characters.'),
            'password.confirmed' => __('Password and confirm password is not matched'),
             .......
        ]; 
    }
```
- **[Controller](#)**
```
Controller Structure (app/Http/Controllers):

├── Api
│   ├── Auth
│   │   ├── LoginController.php
│   │   └── RegisterController.php
│   └── KhojTheSearch
│       └── KhojTheSearchController.php
├── Controller.php
└── Web
    ├── Auth
    │   ├── LoginController.php
    │   └── RegisterController.php
    └── KhojTheSearch
        └── KhojTheSearchController.php


```
```
   
    How to make controller class?
    For Api:  php artisan make:controller Api/TestModule/TestController
    
    Example code:
    
     /**
     * @param TestRequest $request
     * @return JsonResponse
     */
    public function testMethod(TestRequest $request): JsonResponse {
        return response()->json($this->testService->testFunction($request));
    }
    
    For Web:  php artisan make:controller Web/TestModule/TestController
    
    public function testMethod(TestRequest $request): RedirectResponseAlias {
        return $this->webResponse($this->testService->testFunction($request), 'redirect route name');
    }
    
    About webResponse method:
    
        webResponse(
            array $serviceResponse, 
            string $successRoute = null, 
            string $failedRoute = null,
            array $successRouteParameter = [], 
            array $failedRouteParameter
        )
    
    In controller class, we does not write our bussiness logic, it will 
    just receive the request and pass the response.
```
- **[Services](#)**

```
Services Structure (app/Http/Services):

├── Auth
│   ├── Api
│   │   ├── LoginService.php
│   │   ├── LogoutService.php
│   │   ├── OAuthAccessTokenService.php
│   │   └── RegisterService.php
│   └── Web
│       ├── LoginService.php
│       ├── LogoutService.php
│       └── RegisterService.php
├── Boilerplate
│   ├── BaseService.php
│   └── ResponseService.php
├── KhojTheSearch
│   └── KhojTheSearchService.php
└── UserService.php
```

```
    In Service class, we only write our business logic, then 
    return the required data to the controller class.

    How to make a service class?
    $ php artisan make: service TestService
    
    This command will create a service class and also create a template. You only need
    a few lines of code. If you don't comfortable with the template then 
    you can easily write your own method for the service class.
    
    In the service class, we can use a special method 
    called response.
    
    
    public function someFunc($request_data) {
        // process data
        // if have some other thing to do
        // Anything save to data on database call Repository class
        ......
        if anythin went wrong:
            return $this->response()->error();
        
        return $this->response()->success();     
    }
    
    If you need to send any data, pass in the response method,
    return $this->response($data)->error();
    
    If want to send any success message send a success message.
    return $this->response($data)->success("something is created successfully");
    
    Similarly to send any error message send in the error method.
    return $this->response($data)->error("any error message you want to write");
    
    If we only use it as 
    return $this->response($data)->error();
    By default the error message will be something went wrong.
    
    If you want to customize the default error message or other things,
    checkout on "ResponseService" in App\Http\Services\Boilerplate dir.  
```
- **[Repository](#)**
```
Repositories Structure (app/Http/Repositories):

├── BaseRepository.php
├── KhojTheSearchRepository.php
├── OAuthAccessTokenRepository.php
└── UserRepository.php
```
```
    If you need to query anything on the database, write the function on 
    repository class.
    
    All repository classes inherited abstract BaseRepository class.
    BaseRepository class provides lots of query methods that we use 
    most frequently. Besides if you need to write a new query, you 
    will write on the repository class.
    
    You can create a Repository class by running the artisan command.
    
    $ php artisan make: repository TestRepository
    
    In the service class, use the repository class as,
    
    $updateTestResponse = $this->testRepository->updateWhere(
                ['id' => $request->test_id],
                $this->updatedData
            );
    If you need to write any customer query write as,
    
    public function getUserLatestResetCode (int $userId) {
    
        return $this->model::where(
            ['user_id' => $userId, 'status' => PENDING_STATUS])
            ->orderBy('id', 'desc')
            ->first();
    }
```
### Why this pattern?

Workflow: Route -> Request -> Controller -> Service -> Repository

Why this structure?
1. If our projects grows, we can easily add new module.
2. Easy to understand and find errors.
3. If anything need to change, we can easily change it.
   Ex. Present Situation: get_all_inputs need to paginate.
   Then need to go only KhojTheSearch Repository, Then 
   chane only one line of code!!
```
    Pasent code:
    public function userAllInputs(int $userId, $from, $to) {
        return $this->model::select('created_at as timestamp', 'input_values')
            ->where(['user_id' => $userId])
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }
  ```  
    After changing the requirements:

    public function userAllInputs(int $userId, $from, $to) {
        return $this->model::select('created_at as timestamp', 'input_values')
            ->where(['user_id' => $userId])
            ->whereBetween('created_at', [$from, $to])
            ->simplePaginate(5); 
    }
    





