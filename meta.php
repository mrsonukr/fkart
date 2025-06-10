<div class="loader-container">
    <div class="page-loader"></div>
</div>
<style>
    /* Loader container styles */
    .loader-container {
        position: fixed;
        /* Fixes the loader to the viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        /* Optional: semi-transparent background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Ensures the loader is above all other content */
    }

    .page-loader {
        width: 32px;
        aspect-ratio: 1;
        border-radius: 50%;
        border: 3px solid #2874f0;
        animation:
            pl-1 0.8s infinite linear alternate,
            pl-2 1.6s infinite linear;
    }

    @keyframes pl-1 {
        0% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 50% 0%, 50% 0%, 50% 0%, 50% 0%)
        }

        12.5% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 0%, 100% 0%, 100% 0%)
        }

        25% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 100% 100%, 100% 100%)
        }

        50% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%)
        }

        62.5% {
            clip-path: polygon(50% 50%, 100% 0, 100% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%)
        }

        75% {
            clip-path: polygon(50% 50%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 50% 100%, 0% 100%)
        }

        100% {
            clip-path: polygon(50% 50%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 0% 100%)
        }
    }

    @keyframes pl-2 {
        0% {
            transform: scaleY(1) rotate(0deg)
        }

        49.99% {
            transform: scaleY(1) rotate(135deg)
        }

        50% {
            transform: scaleY(-1) rotate(0deg)
        }

        100% {
            transform: scaleY(-1) rotate(-135deg)
        }
    }
</style>
<script>
    window.onload = function () {
        // Hide the loader container once the page is fully loaded
        const loaderContainer = document.querySelector('.loader-container');
        loaderContainer.style.display = 'none'; // Optionally hide it
        loaderContainer.remove(); // Remove it from the DOM
    };
</script>