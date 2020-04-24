<?

require_once '../core/DBRegistrationData.php';

class DB
{

    //статус подключения
    public $isConn;
    //экземрляр подключения к базе данных
    protected $datab;

    //connect db
    public function __construct($username = DB_USER, $password = DB_PASSWORD, $host = DB_HOST, $dbname = DB_NAME, $charset = DB_CHARSET, $options = [])
    {
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname}; charset={$charset}", $username, $password, $options);

            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->isConn = TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            $this->isConn = FALSE;
        }
    }

    //disconnect db
    public function disconnect()
    {
        $this->datab = NULL;
        $this->isConn = FALSE;
    }

    //get row
    public function getRow($query, $params = [])
    {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            return FALSE;
        }
    }

    //get rows
    public function getRows($query, $params = [])
    {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            return FALSE;
        }
    }

    //insert row
    public function insertRow($query, $params = [])
    {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            return FALSE;
        }
    }

    //update row
    public function updateRow($query, $params = [])
    {
        try {
            $this->insertRow($query, $params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            return FALSE;
        }
    }

    //delete row
    public function deleteRow($query, $params = [])
    {
        $this->insertRow($query, $params);
    }
}
