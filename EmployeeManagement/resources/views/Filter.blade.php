<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background: #f0f2f5;
        font-family: 'Segoe UI', Arial, sans-serif;
    }

    .admin_panel {
        height: 100vh;
        width: 20vw;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
        transition: all 0.5s ease;
        overflow: hidden;
    }

    .admin_panel2 {
        height: 100vh;
        width: 80px;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
        transition: all 0.5s ease;
        overflow: hidden;
    }

    .three_line_container {
        height: 60px;
        width: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        margin: 10px;
        transition: all 0.3s ease;
    }

    .three_line_container:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.05);
    }

    .three_line {
        height: 3px;
        width: 30px;
        background: #fff;
        margin: 3px 0;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .panel_ul {
        list-style: none;
        padding: 20px 0;
    }

    .panel_ul li {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        margin: 8px 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .panel_ul li:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
    }

    .panel_ul li:hover img {
        filter: brightness(1) invert(0);
    }

    .panel_ul li img {
        height: 32px;
        width: 32px;
        filter: brightness(0) invert(1);
        transition: all 0.3s ease;

        &:hover {
            filter: brightness(1) invert(0);
        }
    }

    .panel_ul li span {
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        padding-left: 15px;
        opacity: 0.9;
        transition: all 0.3s ease;
    }

    .panel_ul li:hover span {
        opacity: 1;
    }

    .admin_panel .panel_ul li span {
        display: block;
    }

    .admin_panel2 .panel_ul li span {
        display: none;
    }

    .admin_panel .three_line_container:hover .three_line:nth-child(1) {
        transform: translateY(-2px);
    }

    .admin_panel .three_line_container:hover .three_line:nth-child(3) {
        transform: translateY(2px);
    }
</style>
<div style="display: flex;">
    <div class="admin_panel2" id="panel">
        <button class="three_line_container" onclick="ExpandMenu()">
            <div class="three_line"></div>
            <div class="three_line"></div>
            <div class="three_line"></div>
        </button>

        <ul class="panel_ul">
            <a href="/adminPanel/records">
                <li>
                    <img src="{{ URL('Images/directory.png') }}" alt="Records">
                    <span>Records</span>
                </li>
            </a>
            <a href="/adminPanel/generate_user">
                <li>
                    <img src="{{ URL('Images/working.png') }}" alt="Generate User">
                    <span>Generate User</span>
                </li>
            </a>
            <a href="/adminPanel/downloadData">
                <li>
                    <img src="{{ URL('Images/download.png') }}" alt="Download Data">
                    <span>Download Data</span>
                </li>
            </a>
            <a href="/adminPanel/search_user">
                <li>
                    <img src="{{ URL('Images/cv.png') }}" alt="Search User">
                    <span>Search User</span>
                </li>
            </a>
            <a href="/adminPanel/holiday">
                <li>
                    <img src="{{ URL('Images/cv.png') }}" alt="Search User">
                    <span>Holiday Settings</span>
                </li>
            </a>
            <li style="background-color: red; color:white; display: flex; justify-content: center; align-items: center;cursor: pointer;">
                <!-- <img src="{{ URL('Images/cv.png') }}" alt="Search User"> -->
                <form action="/logout" method="post">
                    @csrf
                    <button id="logout" style="display: flex; flex: 1; background-color: transparent; color: white; border: none;" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    <div style="flex: 1;"></div>
</div>
<script>
    function ExpandMenu() {
        const panel = document.querySelector('#panel');
        if (panel) {
            if (panel.classList.contains('admin_panel2')) {
                panel.classList.remove('admin_panel2');
                panel.classList.add('admin_panel');
            } else {
                panel.classList.remove('admin_panel');
                panel.classList.add('admin_panel2');
            }
        } else {
            console.error('Element with ID #panel not found!');
        }
    }
</script>