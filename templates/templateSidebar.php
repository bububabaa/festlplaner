<!-- Sidebar -->
<div id="sidebar">

    <div class="inner">

        <!-- Search Box -->
        <section id="search" class="alt">
            <form method="get" action="#">
                <input type="text" name="search" id="search" placeholder="Search..." />
            </form>
        </section>

        <!-- Menu -->
        <nav id="menu">
            <ul>
                <li><a href="index.php">Homepage</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="kalender.php">Kalender</a></li>
                <li><a href="galerie.php">Galerie</a></li>
                <li><a href="karte.php">Karte</a></li>
                <li>
                    <span class="opener">Abos</span>
                    <ul>
                        <li><a href="#">Abo 1</a></li>
                        <li><a href="#">Abo 2</a></li>
                        <li><a href="#">Abo 3</a></li>
                    </ul>
                </li>
                <li><a target="_blank" href="https://hakmistelbach.ac.at/">externer Link</a></li>
                <li><a href="ueberuns.php">Über uns</a></li>
            </ul>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
        <script>
            const options = {
                bottom: '64px', // default: '32px'
                right: '32px', // default: '32px'
                left: 'unset', // default: 'unset'
                time: '0.5s', // default: '0.3s'
                mixColor: '#fff', // default: '#fff'
                backgroundColor: '#fff', // default: '#fff'
                buttonColorDark: '#100f2c', // default: '#100f2c'
                buttonColorLight: '#fff', // default: '#fff'
                saveInCookies: false, // default: true,
                label: '🌓', // default: ''
                autoMatchOsTheme: true // default: true
            }

            const darkmode = new Darkmode(options);
            darkmode.showWidget();

            new Darkmode(options), showWidget();
        </script>

        <!-- Footer -->
        <footer id="footer">
            <p class="copyright">Copyright &copy; 2021 Festlplaner &amp; Co. KG
                <br>Erstellt von <a rel="nofollow" href="">Uns</a>
            </p>
        </footer>

    </div>
</div>
