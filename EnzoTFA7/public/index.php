<?php

// Composer-free InfinityFree fallback. The full Laravel source remains in this project.
session_start();
$root = dirname(__DIR__);
$dbFile = $root.'/database/database.sqlite';
$uploadDir = $root.'/uploads/avatars';
if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0755, true); }
try {
    $db = new PDO('sqlite:'.$dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('CREATE TABLE IF NOT EXISTS customers (id INTEGER PRIMARY KEY AUTOINCREMENT, full_name TEXT NOT NULL, email TEXT NOT NULL, phone TEXT, created_at TEXT, updated_at TEXT)');
    $db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT NOT NULL UNIQUE, full_name TEXT NOT NULL, avatar TEXT, created_at TEXT, updated_at TEXT)');
    try { $db->exec('ALTER TABLE users ADD COLUMN avatar TEXT'); } catch (Throwable $e) { }
    if ((int)$db->query('SELECT COUNT(*) FROM customers')->fetchColumn() === 0) {
        $now = date('Y-m-d H:i:s');
        $q = $db->prepare('INSERT INTO customers(full_name,email,phone,created_at,updated_at) VALUES(?,?,?,?,?)');
        foreach ([['Philline Perez','philline.perez@example.com','0917 555 0101'],['Alexa Gallardo','alexa.gallardo@example.com','0917 555 0102'],['Eunice Castenares','eunice.castenares@example.com','0917 555 0103']] as $row) { $q->execute([$row[0],$row[1],$row[2],$now,$now]); }
    }
    if ((int)$db->query('SELECT COUNT(*) FROM users')->fetchColumn() === 0) {
        $now = date('Y-m-d H:i:s');
        $q = $db->prepare('INSERT INTO users(username,full_name,created_at,updated_at) VALUES(?,?,?,?)');
        foreach ([['enzo.reyes','Enzo Reyes'],['mia.santos','Mia Santos'],['noah.cruz','Noah Cruz']] as $row) { $q->execute([$row[0],$row[1],$now,$now]); }
    }
} catch (Throwable $e) { http_response_code(500); exit('Database connection is unavailable.'); }
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function path_name(){return rtrim(parse_url($_SERVER['REQUEST_URI']??'/',PHP_URL_PATH)?:'/','/')?:'/';}
function go($p){header('Location: '.$p);exit;}
function csrf(){if(empty($_SESSION['csrf']))$_SESSION['csrf']=bin2hex(random_bytes(16));return $_SESSION['csrf'];}
function oldv($k,$f=''){return e($_SESSION['old'][$k]??$f);}
function save_errors($a){$_SESSION['errors']=$a;$_SESSION['old']=$_POST;}
function css() {
    return <<<'CSS'
:root {
    --ink: #14263d;
    --muted: #56677b;
    --line: #dce6ed;
    --bg: #f4f8fc;
    --brand: #087f8c;
    --dark: #075d69;
    --accent: #4f46e5;
}

* { box-sizing: border-box; }

body {
    margin: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
    color: var(--ink);
    background: radial-gradient(ellipse at top left, #e0f4f1, transparent 55%), var(--bg);
}

a { color: inherit; text-decoration: none; }
a, button, input { -webkit-tap-highlight-color: transparent; }

a:focus-visible, button:focus-visible, input:focus-visible {
    outline: 3px solid var(--accent);
    outline-offset: 4px;
}

nav {
    position: sticky;
    top: 0;
    z-index: 20;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    min-height: 76px;
    padding: 14px max(20px, calc((100% - 1120px) / 2));
    background: #fff;
    border-bottom: 1px solid var(--line);
    box-shadow: 0 4px 22px #14263d06;
}

.brand {
    font-size: 22px;
    font-weight: 850;
    letter-spacing: -.04em;
}

.brand span { color: var(--brand); }

.links {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 6px;
}

.links a {
    padding: 11px 15px;
    border-radius: 12px;
    color: var(--muted);
    font-size: 14px;
    font-weight: 650;
}

.links a:hover, .links a.active {
    color: var(--dark);
    background: #e5f5f2;
}

.nav-toggle { display: none; }

main {
    width: 100%;
    max-width: 1120px;
    margin: 0 auto;
    padding: 56px 24px;
    flex: 1;
}

h1 {
    font-size: clamp(32px, 5vw, 52px);
    line-height: 1.12;
    letter-spacing: -.045em;
    margin: 14px 0 18px;
    overflow-wrap: anywhere;
}

p { color: var(--muted); line-height: 1.75; }

.hero {
    display: grid;
    grid-template-columns: 1.35fr 1fr;
    gap: 40px;
    align-items: center;
    padding: 28px 0 48px;
}

.hero > * { min-width: 0; }
.hero h1 { font-size: clamp(38px, 5.5vw, 62px); }
.hero p { font-size: 17px; max-width: 580px; }

.eyebrow {
    color: var(--dark);
    font-weight: 800;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .13em;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 26px;
}

.button, button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 46px;
    padding: 12px 18px;
    border: 1px solid transparent;
    border-radius: 12px;
    background: var(--brand);
    color: #fff;
    font: inherit;
    font-weight: 700;
    text-align: center;
    cursor: pointer;
    transition: background .18s ease, transform .18s ease, box-shadow .18s ease;
}

.button:hover, button:hover {
    background: var(--dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 18px #075d6922;
}

.button:active, button:active { transform: translateY(0); }

.button.secondary {
    color: #3730a3;
    background: #eef0ff;
    border-color: #cdd1fc;
}

.button.secondary:hover { background: #e0e4ff; }

.hero-panel {
    padding: 28px;
    border-radius: 24px;
    background: linear-gradient(135deg, #123d52, #075d69);
    color: #fff;
    box-shadow: 0 20px 45px #123d5220;
}

.hero-panel .eyebrow { color: #a2eadd; }

.hero-panel h2 {
    font-size: 26px;
    letter-spacing: -.03em;
    margin: 14px 0 8px;
}

.hero-panel p {
    color: #d1e8ed;
    margin-bottom: 22px;
    font-size: 15px;
}

.quick-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 16px;
    margin-top: 12px;
    background: #ffffff12;
    border: 1px solid #ffffff33;
    border-radius: 14px;
    font-weight: 650;
    transition: background .18s ease, transform .18s ease;
}

.quick-link:hover {
    background: #ffffff26;
    transform: translateX(3px);
}

.grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
}

.card {
    padding: 24px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid var(--line);
    transition: transform .18s ease, box-shadow .18s ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px #14263d0d;
}

.card h3 { margin: 0 0 8px; font-size: 18px; }
.card p { margin: 0; font-size: 14px; }

.card-label {
    display: inline-block;
    margin-bottom: 18px;
    color: var(--dark);
    background: #e5f5f2;
    border-radius: 8px;
    padding: 6px 10px;
    font-size: 12px;
    font-weight: 750;
}

.toolbar {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: end;
    gap: 18px;
    margin-bottom: 24px;
}

.toolbar h1 { margin-bottom: 8px; }
.toolbar p { margin-bottom: 0; }

.table-wrap, .form-card {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 18px;
    box-shadow: 0 8px 24px #14263d05;
}

.table-wrap { overflow-x: auto; }

.data {
    border-collapse: collapse;
    width: 100%;
    min-width: 680px;
}

.data th, .data td {
    text-align: left;
    padding: 16px 18px;
    border-bottom: 1px solid var(--line);
    font-size: 14px;
}

.data th {
    font-size: 11px;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--dark);
    background: #f0f8f8;
}

.data tr:last-child td { border-bottom: 0; }
.data tr:hover td { background: #f5fbfa; }

.id, .table-link { color: var(--dark); font-weight: 750; }
.table-link:hover { text-decoration: underline; }

.form-card {
    padding: clamp(18px, 4vw, 30px);
    max-width: 680px;
}

.field { margin-bottom: 18px; }

.field label {
    display: block;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 8px;
}

.field small { color: var(--muted); font-weight: 400; }

.field input {
    width: 100%;
    min-width: 0;
    padding: 13px;
    border: 1px solid #bfcdd8;
    border-radius: 10px;
    font: inherit;
    color: var(--ink);
    background: #fff;
}

.field input:focus { border-color: var(--brand); }

.actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--line);
}

.alert {
    padding: 14px 16px;
    border-radius: 12px;
    margin-bottom: 18px;
}

.error { background: #fff0ee; color: #ad3025; }

.avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    background: #e5f5f2;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 750;
    color: var(--dark);
}

footer {
    text-align: center;
    color: var(--muted);
    padding: 26px 20px;
    font-size: 13px;
}

@media (max-width: 760px) {
    main { padding: 32px 18px; }

    .hero {
        grid-template-columns: 1fr;
        gap: 26px;
        padding: 12px 0 30px;
    }

    .grid { grid-template-columns: 1fr; }
    .hero-panel { padding: 24px; }
    .toolbar { align-items: flex-start; flex-direction: column; }
    .links { width: 100%; }
    .links a { flex: 1; text-align: center; }

    .js .nav-toggle {
        display: inline-flex;
        padding: 9px 14px;
        min-height: 44px;
    }

    .js .links { display: none; }
    .js .links.is-open { display: flex; }
}

@media (max-width: 420px) {
    .hero-actions { flex-direction: column; }
    .hero-actions .button { width: 100%; }
    .actions > * { flex: 1; }
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        transition: none !important;
        transform: none !important;
    }
}
CSS;
}
function layout($title, $body) {
    $pageTitle = e($title);
    $styles = css();

    echo <<<HTML
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$pageTitle} | EnzoTFA7</title>
    <style>{$styles}</style>
</head>
<body>
    <nav aria-label="Main navigation">
        <a class="brand" href="/">Enzo<span>TFA7</span></a>

        <button
            class="nav-toggle"
            type="button"
            aria-expanded="false"
            aria-controls="site-links"
        >Menu</button>

        <div class="links" id="site-links">
            <a href="/">Home</a>
            <a href="/customers">Customers</a>
            <a href="/users">Users</a>
        </div>
    </nav>

    <main>{$body}</main>

    <footer>IT0049 Web System Technologies &middot; EnzoTFA7</footer>

    <script>
    (() => {
        const toggle = document.querySelector('.nav-toggle');
        const links = document.getElementById('site-links');
        const current = window.location.pathname.replace(/\/+$/, '') || '/';

        links.querySelectorAll('a').forEach(link => {
            const target = link.getAttribute('href');

            if (
                current === target ||
                (target !== '/' && current.startsWith(target + '/'))
            ) {
                link.classList.add('active');

                if (current === target) {
                    link.setAttribute('aria-current', 'page');
                }
            }
        });

        function closeMenu() {
            links.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.textContent = 'Menu';
        }

        toggle.addEventListener('click', () => {
            const open = links.classList.toggle('is-open');

            toggle.setAttribute('aria-expanded', String(open));
            toggle.textContent = open ? 'Close' : 'Menu';
        });

        document.addEventListener('keydown', event => {
            if (
                event.key === 'Escape' &&
                links.classList.contains('is-open')
            ) {
                closeMenu();
                toggle.focus();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 760) closeMenu();
        });

        document.documentElement.classList.add('js');
    })();
    </script>
</body>
</html>
HTML;
}
function form_page($type,$r=null){$user=$type==='user';$edit=$r!==null;$kind=$user?'User':'Customer';$errors=$_SESSION['errors']??[];unset($_SESSION['errors']);$action=$user?'/users':'/customers';if($edit)$action.='/'.$r['id'];$body='<div class="eyebrow">'.$kind.' accounts</div><h1>'.($edit?'Edit ':'Add ').$kind.'</h1><p>'.($user?'Create or update an account and optionally upload a profile picture.':'Create or update a customer record.').'</p>';if($errors){$body.='<div class="alert error"><strong>Please correct the following:</strong><ul>';foreach($errors as $x)$body.='<li>'.e($x).'</li>';$body.='</ul></div>';}$body.='<form class="form-card" method="POST" action="'.$action.'"'.($user&&$edit?' enctype="multipart/form-data"':'').'><input type="hidden" name="_token" value="'.e(csrf()).'"><input type="hidden" name="_method" value="'.($edit?'PATCH':'POST').'">';if($user)$body.='<div class="field"><label>Username</label><input name="username" required value="'.oldv('username',$r['username']??'').'" ></div>';$body.='<div class="field"><label>Full name</label><input name="full_name" required value="'.oldv('full_name',$r['full_name']??'').'" ></div>';if($user&&$edit)$body.='<div class="field"><label>Profile picture <small>JPG or PNG, max 2MB</small></label><input type="file" name="avatar" accept="image/jpeg,image/png"></div>';if(!$user)$body.='<div class="field"><label>Email address</label><input type="email" name="email" required value="'.oldv('email',$r['email']??'').'" ></div><div class="field"><label>Phone</label><input name="phone" value="'.oldv('phone',$r['phone']??'').'" ></div>';$body.='<div class="actions"><a class="button secondary" href="'.($user?'/users':'/customers').'">Cancel</a><button type="submit">'.($edit?'Update':'Save').' '.$kind.'</button></div></form>';unset($_SESSION['old']);layout(($edit?'Edit ':'Add ').$kind,$body);}
$path=path_name();$method=$_SERVER['REQUEST_METHOD']??'GET';
if($method==='POST'&&!hash_equals($_SESSION['csrf']??'',$_POST['_token']??'')){http_response_code(419);exit('Page expired.');}
if($method==='POST'){$isUser=str_starts_with($path,'/users');$id=(int)preg_replace('/^\/(?:customers|users)\/(\d+)$/','$1',$path);$data=['full_name'=>trim($_POST['full_name']??'')];$errs=[];if($data['full_name']==='')$errs[]='Full name is required.';if($isUser){$data['username']=trim($_POST['username']??'');if($data['username']==='')$errs[]='Username is required.';$q=$db->prepare('SELECT id FROM users WHERE username=? AND id<>?');$q->execute([$data['username'],$id]);if($q->fetch())$errs[]='Username has already been taken.';}else{$data['email']=trim($_POST['email']??'');$data['phone']=trim($_POST['phone']??'');if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))$errs[]='A valid email address is required.';}$edit=$id>0;if($isUser&&$edit&&!empty($_FILES['avatar']['name'])){$f=$_FILES['avatar'];if($f['error']!==UPLOAD_ERR_OK||$f['size']>2097152||!@getimagesize($f['tmp_name'])||!in_array(strtolower(pathinfo($f['name'],PATHINFO_EXTENSION)),['jpg','jpeg','png'],true))$errs[]='Avatar must be a JPG or PNG image no larger than 2MB.';}if($errs){save_errors($errs);go($isUser?($edit?'/users/'.$id.'/edit':'/users/create'):($edit?'/customers/'.$id.'/edit':'/customers/create'));}$now=date('Y-m-d H:i:s');if($isUser){if($edit){$q=$db->prepare('UPDATE users SET username=?,full_name=?,updated_at=? WHERE id=?');$q->execute([$data['username'],$data['full_name'],$now,$id]);}else{$q=$db->prepare('INSERT INTO users(username,full_name,created_at,updated_at) VALUES(?,?,?,?)');$q->execute([$data['username'],$data['full_name'],$now,$now]);$id=(int)$db->lastInsertId();}if($edit&&!empty($_FILES['avatar']['name'])){$f=$_FILES['avatar'];$name='avatar_'.bin2hex(random_bytes(8)).'.'.strtolower(pathinfo($f['name'],PATHINFO_EXTENSION));move_uploaded_file($f['tmp_name'],$uploadDir.'/'.$name);$q=$db->prepare('UPDATE users SET avatar=? WHERE id=?');$q->execute([$name,$id]);}go('/users');}else{if($edit){$q=$db->prepare('UPDATE customers SET full_name=?,email=?,phone=?,updated_at=? WHERE id=?');$q->execute([$data['full_name'],$data['email'],$data['phone'],$now,$id]);}else{$q=$db->prepare('INSERT INTO customers(full_name,email,phone,created_at,updated_at) VALUES(?,?,?,?,?)');$q->execute([$data['full_name'],$data['email'],$data['phone'],$now,$now]);}go('/customers');}}
if(preg_match('#^/(customers|users)/(\d+)/edit$#',$path,$m)){$table=$m[1];$q=$db->prepare("SELECT * FROM $table WHERE id=?");$q->execute([(int)$m[2]]);$r=$q->fetch(PDO::FETCH_ASSOC);if(!$r){http_response_code(404);exit('Record not found.');}form_page($table==='users'?'user':'customer',$r);exit;}if($path==='/customers/create'){form_page('customer');exit;}if($path==='/users/create'){form_page('user');exit;}
if($path==='/customers'||$path==='/users'){$table=ltrim($path,'/');$rows=$db->query("SELECT * FROM $table ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);$body='<div class="toolbar"><div><div class="eyebrow">Account management</div><h1>'.ucfirst($table).' Accounts</h1><p>Records managed with validated forms.</p></div><a class="button" href="/'.$table.'/create">+ Add '.($table==='users'?'User':'Customer').'</a></div><div class="table-wrap"><table class="data"><tr><th>ID</th>'.($table==='users'?'<th>Avatar</th><th>Username</th><th>Full Name</th>':'<th>Full Name</th><th>Email</th><th>Phone</th>').'<th>Action</th></tr>';foreach($rows as $r){$body.='<tr><td class="id">'.e($r['id']).'</td>';if($table==='users'){$av=$r['avatar']?'<img class="avatar" src="/uploads/avatars/'.e($r['avatar']).'" alt="Avatar">':'<span class="avatar">'.e(strtoupper(substr($r['full_name'],0,1))).'</span>';$body.='<td>'.$av.'</td><td>'.e($r['username']).'</td><td>'.e($r['full_name']).'</td>';}else{$body.='<td>'.e($r['full_name']).'</td><td>'.e($r['email']).'</td><td>'.e($r['phone']).'</td>';} $body.='<td><a class="table-link" href="/'.$table.'/'.$r['id'].'/edit">Edit</a></td></tr>';}layout(ucfirst($table).' Accounts',$body.'</table></div>');exit;}
if ($path === '/') {
    $home = <<<'HTML'
<section class="hero">
    <div>
        <div class="eyebrow">EnzoTFA7 account management</div>

        <h1>Your accounts.<br>All in one place.</h1>

        <p>
            Manage customer records, update user accounts, and upload
            profile photos in a few simple steps.
        </p>

        <div class="hero-actions">
            <a class="button" href="/customers">
                View customer accounts
                <span aria-hidden="true">&rarr;</span>
            </a>

            <a class="button secondary" href="/users">
                View users
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>

    <aside class="hero-panel" aria-label="Quick actions">
        <div class="eyebrow">Quick actions</div>

        <h2>Ready to add someone?</h2>

        <p>
            Create a customer record or a user account to get started.
        </p>

        <a class="quick-link" href="/customers/create">
            Add a customer
            <span aria-hidden="true">&rarr;</span>
        </a>

        <a class="quick-link" href="/users/create">
            Add a user
            <span aria-hidden="true">&rarr;</span>
        </a>
    </aside>
</section>

<section class="grid" aria-label="Account features">
    <article class="card">
        <span class="card-label">Customers</span>
        <h3>Organized records</h3>
        <p>
            Keep customer names, email addresses, and phone numbers together.
        </p>
    </article>

    <article class="card">
        <span class="card-label">Users</span>
        <h3>Easy account updates</h3>
        <p>
            Create users and edit their names and usernames when needed.
        </p>
    </article>

    <article class="card">
        <span class="card-label">Profile photos</span>
        <h3>A personal touch</h3>
        <p>
            Add a JPG or PNG profile photo up to 2MB from the user edit page.
        </p>
    </article>
</section>
HTML;

    layout('Home', $home);
    exit;
}

http_response_code(404);

layout(
    'Page not found',
    '<h1>404</h1><p>The requested page could not be found.</p>'
);
