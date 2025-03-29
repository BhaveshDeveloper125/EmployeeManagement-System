<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
    @if (Route::has('login'))
    <nav class="flex items-center justify-end gap-4">
        @auth
        <a
            href="{{ url('/home') }}"
            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
            Dashboard
        </a>
        @else
        <a
            href="{{ route('login') }}"
            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
            Log in
        </a>

        <!-- @if (Route::has('register'))
        <a
            href="{{ route('register') }}"
            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
            Register
        </a>
        @endif -->
        @endauth
    </nav>
    @endif
</header>

<form action="/ipaddress" class="ipform" method="post">
    @csrf
    <input type="text" name="ip" class="ip" readonly required>
</form>


<script>
    fetch('https://api.ipify.org/?format=json')
        .then(res => res.json())
        .then(data => {
            console.log(`IP address : ${data.ip}`)
            const IP = data.ip;
            document.querySelector('.ip').value = IP;
            document.querySelector('.ipform').submit();

        })
</script>