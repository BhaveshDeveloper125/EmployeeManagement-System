<div id="loader" class="loader_container">
    <img src="{{ URL('Images/loader.gif') }}" alt="Loading...">
</div>

<style>
    .loader_container {
        height: 100vh;
        width: 100vw;
        background-color: rgba(0, 0, 0, 0.5);
        /* Slight transparency */
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
    }

    .hidden {
        display: none;
    }
</style>

<script>
    window.addEventListener('load', function() {
        const loader = document.querySelector('#loader');
        loader.classList.add('hidden');
    });
</script>