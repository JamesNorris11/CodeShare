<?php
    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
        <title>CodeShare</title>
        <meta name="description" content="CodeShare">
        <meta name="author" content="JN">

        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/index.css">

        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
   </head>
   <body>
    <header>
        <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

        <?php
        if ($_GET['m'] == 1) {
            echo '<span id="message">Your account has been successfully created!</span>';
        }
        ?>

            <ul id="navList">
                <li class="navButton"><a href="index.php" id="active">New Upload</a></li>
                <li class="navButton"><a href="search.php">Search</a></li>
                <?php
                    echo $session->get("loggedIn") ? '<li class="navButton"><a href="profile.php">My Profile</a></li>' : '';
                    echo !$session->get("loggedIn") ? '<li class="navButton"><a href="login.php">Login</a></li>' : '';
                    echo !$session->get("loggedIn") ? '<li class="navButton"><a href="register.php">Register</a></li>' : '';
                    echo $session->get("loggedIn") ? '<li class="navButton"><a href="logout.php">Logout</a></li>' : '';
                ?>
            </ul>
    </header>
    <main>
        <aside>
            <span class="title stats">Total Users</span>
            <span class="number stats"><?php echo number_format(CS::getStats('Jds3f')['users']); ?></span>
            <span class="title stats">Total Posts</span>
            <span class="number stats"><?php echo number_format(CS::getStats('Jds3f')['posts']); ?></span>

            <img src="images/notebook.jpg" id="noteBookImage">
        </aside>
        <section>
                <form action="addpost.php" method="post" id="addPostForm" name="mainForm">

                    <label for="content" class="labelAbove">Text to Upload</label>
                    <span class="hoverHelp" id="helpTextUpload">?</span>
                    <textarea name="content" class="textarea" id="content" cols=""></textarea>
                    <span id="helpMessage"></span>

                    <label for="description" class="labelAbove">Description *</label>
                    <span class="hoverHelp" id="helpDescription">?</span>
                    <textarea id="description" name="description" cols="" class="textarea"></textarea>

                    <label for="password">Post Password *</label>
                    <input type="Password" class="input horizontalInput" id="password" name="password">
                    <span class="hoverHelp" id="helpPassword">?</span>

                    <label class="marginLabel" for="language">Syntax Highlighting *</label>
                    <select class="input horizontalInput" name="language">
                        <option label="abap" value="abap">abap</option>
                        <option label="actionscript" value="actionscript">actionscript</option>
                        <option label="actionscript3" value="actionscript3">actionscript3</option>
                        <option label="ada" value="ada">ada</option>
                        <option label="apache" value="apache">apache</option>
                        <option label="applescript" value="applescript">applescript</option>
                        <option label="apt_sources" value="apt_sources">apt_sources</option>
                        <option label="asm" value="asm">asm</option>
                        <option label="asp" value="asp">asp</option>
                        <option label="autoit" value="autoit">autoit</option>
                        <option label="avisynth" value="avisynth">avisynth</option>
                        <option label="bash" value="bash">bash</option>
                        <option label="basic4gl" value="basic4gl">basic4gl</option>
                        <option label="bf" value="bf">bf</option>
                        <option label="bibtex" value="bibtex">bibtex</option>
                        <option label="blitzbasic" value="blitzbasic">blitzbasic</option>
                        <option label="bnf" value="bnf">bnf</option>
                        <option label="boo" value="boo">boo</option>
                        <option label="c" value="c">c</option>
                        <option label="c_mac" value="c_mac">c_mac</option>
                        <option label="caddcl" value="caddcl">caddcl</option>
                        <option label="cadlisp" value="cadlisp">cadlisp</option>
                        <option label="cfdg" value="cfdg">cfdg</option>
                        <option label="cfm" value="cfm">cfm</option>
                        <option label="cil" value="cil">cil</option>
                        <option label="cmake" value="cmake">cmake</option>
                        <option label="cobol" value="cobol">cobol</option>
                        <option label="cpp" value="cpp">cpp</option>
                        <option label="cpp-qt" value="cpp-qt">cpp-qt</option>
                        <option label="csharp" value="csharp">csharp</option>
                        <option label="css" value="css">css</option>
                        <option label="d" value="d">d</option>
                        <option label="dcs" value="dcs">dcs</option>
                        <option label="delphi" value="delphi">delphi</option>
                        <option label="diff" value="diff">diff</option>
                        <option label="div" value="div">div</option>
                        <option label="dos" value="dos">dos</option>
                        <option label="dot" value="dot">dot</option>
                        <option label="eiffel" value="eiffel">eiffel</option>
                        <option label="email" value="email">email</option>
                        <option label="erlang" value="erlang">erlang</option>
                        <option label="fo" value="fo">fo</option>
                        <option label="fortran" value="fortran">fortran</option>
                        <option label="freebasic" value="freebasic">freebasic</option>
                        <option label="genero" value="genero">genero</option>
                        <option label="gettext" value="gettext">gettext</option>
                        <option label="glsl" value="glsl">glsl</option>
                        <option label="gml" value="gml">gml</option>
                        <option label="gnuplot" value="gnuplot">gnuplot</option>
                        <option label="groovy" value="groovy">groovy</option>
                        <option label="haskell" value="haskell">haskell</option>
                        <option label="hq9plus" value="hq9plus">hq9plus</option>
                        <option label="html" value="html5">html5</option>
                        <option label="html5" value="html5">html5</option>
                        <option label="idl" value="idl">idl</option>
                        <option label="ini" value="ini">ini</option>
                        <option label="inno" value="inno">inno</option>
                        <option label="intercal" value="intercal">intercal</option>
                        <option label="io" value="io">io</option>
                        <option label="java" value="java">java</option>
                        <option label="java5" value="java5">java5</option>
                        <option label="javascript" value="javascript">javascript</option>
                        <option label="kixtart" value="kixtart">kixtart</option>
                        <option label="klonec" value="klonec">klonec</option>
                        <option label="klonecpp" value="klonecpp">klonecpp</option>
                        <option label="latex" value="latex">latex</option>
                        <option label="lisp" value="lisp">lisp</option>
                        <option label="locobasic" value="locobasic">locobasic</option>
                        <option label="lolcode" value="lolcode">lolcode</option>
                        <option label="lotusformulas" value="lotusformulas">lotusformulas</option>
                        <option label="lotusscript" value="lotusscript">lotusscript</option>
                        <option label="lscript" value="lscript">lscript</option>
                        <option label="lsl2" value="lsl2">lsl2</option>
                        <option label="lua" value="lua">lua</option>
                        <option label="m68k" value="m68k">m68k</option>
                        <option label="make" value="make">make</option>
                        <option label="matlab" value="matlab">matlab</option>
                        <option label="mirc" value="mirc">mirc</option>
                        <option label="modula3" value="modula3">modula3</option>
                        <option label="mpasm" value="mpasm">mpasm</option>
                        <option label="mxml" value="mxml">mxml</option>
                        <option label="mysql" value="mysql">mysql</option>
                        <option label="none" value="none" selected>none</option>
                        <option label="nsis" value="nsis">nsis</option>
                        <option label="oberon2" value="oberon2">oberon2</option>
                        <option label="objc" value="objc">objc</option>
                        <option label="ocaml" value="ocaml">ocaml</option>
                        <option label="ocaml-brief" value="ocaml-brief">ocaml-brief</option>
                        <option label="oobas" value="oobas">oobas</option>
                        <option label="oracle11" value="oracle11">oracle11</option>
                        <option label="oracle8" value="oracle8">oracle8</option>
                        <option label="pascal" value="pascal">pascal</option>
                        <option label="per" value="per">per</option>
                        <option label="perl" value="perl">perl</option>
                        <option label="php" value="php">php</option>
                        <option label="php-brief" value="php-brief">php-brief</option>
                        <option label="pic16" value="pic16">pic16</option>
                        <option label="pixelbender" value="pixelbender">pixelbender</option>
                        <option label="plsql" value="plsql">plsql</option>
                        <option label="povray" value="povray">povray</option>
                        <option label="powershell" value="powershell">powershell</option>
                        <option label="progress" value="progress">progress</option>
                        <option label="prolog" value="prolog">prolog</option>
                        <option label="properties" value="properties">properties</option>
                        <option label="providex" value="providex">providex</option>
                        <option label="python" value="python">python</option>
                        <option label="qbasic" value="qbasic">qbasic</option>
                        <option label="rails" value="rails">rails</option>
                        <option label="rebol" value="rebol">rebol</option>
                        <option label="reg" value="reg">reg</option>
                        <option label="robots" value="robots">robots</option>
                        <option label="ruby" value="ruby">ruby</option>
                        <option label="sas" value="sas">sas</option>
                        <option label="scala" value="scala">scala</option>
                        <option label="scheme" value="scheme">scheme</option>
                        <option label="scilab" value="scilab">scilab</option>
                        <option label="sdlbasic" value="sdlbasic">sdlbasic</option>
                        <option label="smalltalk" value="smalltalk">smalltalk</option>
                        <option label="smarty" value="smarty">smarty</option>
                        <option label="sql" value="sql">sql</option>
                        <option label="tcl" value="tcl">tcl</option>
                        <option label="teraterm" value="teraterm">teraterm</option>
                        <option label="text" value="text">text</option>
                        <option label="thinbasic" value="thinbasic">thinbasic</option>
                        <option label="tsql" value="tsql">tsql</option>
                        <option label="typoscript" value="typoscript">typoscript</option>
                        <option label="vb" value="vb">vb</option>
                        <option label="vbnet" value="vbnet">vbnet</option>
                        <option label="verilog" value="verilog">verilog</option>
                        <option label="vhdl" value="vhdl">vhdl</option>
                        <option label="vim" value="vim">vim</option>
                        <option label="visualfoxpro" value="visualfoxpro">visualfoxpro</option>
                        <option label="visualprolog" value="visualprolog">visualprolog</option>
                        <option label="whitespace" value="whitespace">whitespace</option>
                        <option label="whois" value="whois">whois</option>
                        <option label="winbatch" value="winbatch">winbatch</option>
                        <option label="xml" value="xml">xml</option>
                        <option label="xorg_conf" value="xorg_conf">xorg_conf</option>
                        <option label="xpp" value="xpp">xpp</option>
                        <option label="z80" value="z80">z80</option>
                    </select>

                    <span class="hoverHelp" id="helpSyntax">?</span>

                    <input type="submit" name="submit" class="submit" value="Submit"/>
                    <span class="marginLabel">* Optional</span>
                </form>
            </section>
        </main>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/index.js"></script>
    </body>
</html>
