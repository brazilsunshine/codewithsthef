<template>
    <div>
        <hr />
        <div class="footer-basic py103">
        <footer>
            <div class="social">
                <a href="https://github.com/brazilsunshine" target="_blank">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.instagram.com/codewithsthef/" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.youtube.com/@codewithsthef" target="_blank">
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a href="https://twitter.com/codewithsthef" target="_blank">
                    <i class="fa-brands fa-twitter"></i>
                </a>
            </div>
            <p class="copyright">codewithsthef © 2023</p>
        </footer>
    </div>
    </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>

    .dark div {
        background: #211a2f;
    }

    .dark hr{
        height: 1px;
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        border: none;
    }

    .dark .footer-basic {
        color: white;
    }

    .footer-basic {
        padding: 40px 0;
        background-color: #ffffff;
        color: #4b4c4d;
    }

    .footer-basic ul {
        padding:0;
        list-style:none;
        text-align:center;
        font-size:18px;
        line-height:1.6;
        margin-bottom:0;
    }

    .footer-basic li {
        padding:0 10px;
    }

    .footer-basic ul a {
        color:inherit;
        text-decoration:none;
        opacity:0.8;
    }

    .footer-basic ul a:hover {
        opacity:1;
    }

    .footer-basic .social {
        text-align:center;
        padding-bottom:25px;
    }

    .footer-basic .social > a {
        font-size:24px;
        width:40px;
        height:40px;
        line-height:40px;
        display:inline-block;
        text-align:center;
        border-radius:50%;
        border:1px solid #ccc;
        margin:0 8px;
        color:inherit;
        opacity:0.75;
    }

    .footer-basic .social > a:hover {
        opacity:0.9;
    }

    .footer-basic .copyright {
        margin-top:15px;
        text-align:center;
        font-size:13px;
        color:#aaa;
        margin-bottom:0;
    }

    .py103 {
        padding: 103px 0;
    }
</style>
