
<div class="sidenav">


                               
                      
<a href="home">
                                    {{ Auth::user()->name }} 
                                </a>
@if (Route::has('login'))
Users Management

<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
<a href="/">Home</a>  
@if (Auth::user()->role =="Administrator")

<a href="/role">Role</a>
  <a href="/usermanager ">Users</a>
  Expenses Management
  <a href="/expense-cat">Category</a>


@endif

<a href="/expense">Expenses</a>
  @endif
                   
</div>
@yieldsection


