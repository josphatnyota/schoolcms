<?php
/**
 * Created by PhpStorm.
 * User: nerd
 * Date: 08/07/2018
 * Time: 14:39
 */

namespace Core\Security;


use \PDO;

class MySQLSessionHandler implements \SessionHandlerInterface
{

    private $_link = null;
    private $_table = "user_sessions";
    private $_sess_id = "sess_id";
    private $_sess_data = "sess_data";
    private $_col_expiry = "sess_expiry";
    private $_expiry ;
    private $_gcStatus = false;
    public function __construct()
    {

        $this->_expiry = time() + (int) ini_get("session.gc_maxlifetime");

        try {

            $ini = parse_ini_file("../helpers/settings.ini", true);
            $dsn = $ini['db']['driver'] . ':host=' . $ini['db']['host'] . ';dbname=' . $ini['db']['dbname'].';charset='.$ini['db']['charset'];
            $this->_link = new PDO($dsn, $ini['db']['user'], $ini['db']['pass'], $options = []);
            session_set_save_handler($this);

        } catch (\PDOException $exc) {

            echo $exc->getMessage();

        }

    }


    /**
     * Close the session
     * @link http://php.net/manual/en/sessionhandlerinterface.close.php
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function close()
    {
        if($this->_gcStatus){


            if($sql = $this->_link->prepare("DELETE FROM {$this->_table} WHERE {$this->_col_expiry}<:{$this->_col_expiry}"))
            {

                $sql->bindValue(":{$this->_col_expiry}",time());
                $sql->execute();
            }


            $this->_gcStatus = false;
        }

        $this->_link = null;

        return true;
    }

    /**
     * Destroy a session
     * @link http://php.net/manual/en/sessionhandlerinterface.destroy.php
     * @param string $session_id The session ID being destroyed.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function destroy($session_id)
    {
        if($sql = $this->_link->prepare("DELETE FROM {$this->_table} WHERE {$this->_sess_id}=:{$this->_sess_id}"))
        {

            $sql->bindValue(":{$this->_sess_id}",$session_id);
            $sql->execute();
        }

        return true;
    }

    /**
     * Cleanup old sessions
     * @link http://php.net/manual/en/sessionhandlerinterface.gc.php
     * @param int $maxlifetime <p>
     * Sessions that have not updated for
     * the last maxlifetime seconds will be removed.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function gc($maxlifetime)
    {
        $this->_gcStatus = true;

        return true;
    }

    /**
     * Initialize session
     * @link http://php.net/manual/en/sessionhandlerinterface.open.php
     * @param string $save_path The path where to store/retrieve the session.
     * @param string $name The session name.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function open($save_path, $name)
    {

        return true;
    }

    /**
     * Read session data
     * @link http://php.net/manual/en/sessionhandlerinterface.read.php
     * @param string $session_id The session id to read data for.
     * @return string <p>
     * Returns an encoded string of the read data.
     * If nothing was read, it must return an empty string.
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function read($session_id)
    {

        $sql = "SELECT `{$this->_sess_data}`,`{$this->_col_expiry}` FROM {$this->_table} WHERE  {$this->_sess_id}=:{$this->_sess_id} ";

        if($query = $this->_link->prepare($sql)){
            $query->bindValue($this->_sess_id,$session_id);
        }
        if($query->execute()){
            if($query->rowCount() < 1)
            {
                if($sql = $this->_link->prepare("INSERT INTO {$this->_table}(`{$this->_sess_id}`,`{$this->_sess_data}`,`{$this->_col_expiry}`) VALUES (:{$this->_sess_id},:{$this->_sess_data},:{$this->_col_expiry})"))
                {

                    $sql->bindValue(":{$this->_sess_id}",$session_id);
                    $sql->bindValue(":{$this->_sess_data}","");
                    $sql->bindValue(":{$this->_col_expiry}",$this->_expiry);
                    $sql->execute();
                    return "";
                }
            }
            $results = $query->fetch(PDO::FETCH_ASSOC);
        }

        return !empty($results[$this->_sess_data]) ? $results[$this->_sess_data] : "";
    }

    /**
     * Write session data
     * @link http://php.net/manual/en/sessionhandlerinterface.write.php
     * @param string $session_id The session id.
     * @param string $session_data <p>
     * The encoded session data. This data is the
     * result of the PHP internally encoding
     * the $_SESSION superglobal to a serialized
     * string and passing it as this parameter.
     * Please note sessions use an alternative serialization method.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function write($session_id, $session_data)
    {

        $sql = "INSERT INTO {$this->_table}(`{$this->_sess_id}`,`{$this->_sess_data}`,`{$this->_col_expiry}`)";
        $sql .= " VALUES (:{$this->_sess_id},:{$this->_sess_data},:{$this->_col_expiry}) ON DUPLICATE KEY UPDATE" ;
        $sql .="  {$this->_sess_data}=:{$this->_sess_data}";
        $sql .= ",{$this->_col_expiry}=:{$this->_col_expiry}";

        if($query = $this->_link->prepare($sql))
        {
            $query->bindValue(":{$this->_sess_id}",$session_id);
            $query->bindValue(":{$this->_sess_data}",$session_data);
            $query->bindValue(":{$this->_col_expiry}",$this->_expiry);
            $query->execute();
        }

        return true;
    }

    public function __destruct()
    {
        session_write_close();
    }

}