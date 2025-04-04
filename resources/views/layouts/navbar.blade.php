<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html">Startmin</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
    </ul>

    <ul class="nav navbar-right navbar-top-links">
        <!-- Notification Bell Icon -->
        <li class="dropdown navbar-inverse">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="bellIcon">
                <i class="fa fa-bell fa-fw"></i>
                <span id="messageCount" class="badge badge-danger"></span> <!-- Notification count -->
            </a>
            <ul class="dropdown-menu dropdown-alerts" id="messageList">
                <li class="text-center"><strong>Loading...</strong></li>
            </ul>
        </li>

        <!-- User Profile Dropdown -->
        <li class="dropdown">
            @if(Auth::check()) <!-- Ensure a user is authenticated -->
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    @if (Auth::user()->image)
                        <img src="{{ asset(Auth::user()->image)}}" width="30" height="30" class="rounded-circle" alt="User Profile Image">
                    @else
                        <i class="fa fa-user fa-fw"></i>
                    @endif 
                    {{ Auth::user()->name}} <b class="caret"></b> 
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ route('profile.view')}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                            <i class="fa fa-sign-out fa-fw"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif
        </li>
    </ul>
    <!-- /.navbar-top-links -->
</nav>

<script>
    function loadUnreadMessages() {
        fetch("{{ route('admin.unreadMessages') }}")
            .then(response => response.json())
            .then(data => {
                let messageList     = document.getElementById("messageList");
                let messageCount    = document.getElementById("messageCount");

                messageList.innerHTML = ""; // Clear old data
                let totalMessages = 0;

                if (data.length === 0) {
                    messageList.innerHTML   = '<li class="text-center"><strong>No new messages</strong></li>';
                    messageCount.innerText  = ""; // Hide badge if no messages
                } else {
                    data.forEach(msg => {
                        totalMessages += msg.message_count;
                        messageList.innerHTML += `
                            <li>
                                <a href="/admin/chat/${msg.user_id}">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> 
                                        <strong>${msg.user.name}</strong> <strong>${msg.message_count}</strong> messages
                                        <span class="pull-right text-muted small">${msg.time_ago}</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>`;                  
                    });
                    messageCount.innerText = totalMessages; // Show total messages in the badge
                }
            })
            .catch(error => console.error('Error loading messages:', error));
    }

    // Load notifications on page load
    document.addEventListener("DOMContentLoaded", loadUnreadMessages);

    // Auto-refresh notifications every 30 seconds
    setInterval(loadUnreadMessages, 30000);
</script>





