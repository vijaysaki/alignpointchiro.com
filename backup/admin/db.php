<?
declare(strict_types=1);

function db(): PDO {
    static $pdo;

    if ($pdo) {
        return $pdo;
    }

    $host = 'db-mysql-nyc3-41243-do-user-16114214-0.k.db.ondigitalocean.com';
    $db   = 'alignpoint';
    $user = 'doadmin';
    $pass = 'AVNS_sa2vO1ti8ImB60BbBSK';
    $port = 25060; // DigitalOcean managed MySQL usually uses this
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 3,
    ]);

    return $pdo;
}
?>