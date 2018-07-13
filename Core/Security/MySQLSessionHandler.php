<?php
/**
 * Created by PhpStorm.
 * User: nerd
 * Date: 08/07/2018
 * Time: 14:39
 */

namespace Core\Security;


use Core\DB;

class MySQLSessionHandler implements \SessionHandlerInterface
{

    private $_link;
    private $_table = "user_sessions";
    private $_sess_id = "sess_id";
    private $_sess_data = "sess_data";
    private $_col_expiry = "sess_expiry";
    private $_expiry ;
    private $_gcStatus = false;
    public function __construct()
    {
        $this->_link = DB::instance();
        $this->_expiry = time() + (int) ini_get("session.gc_maxlifetime");
        session_set_save_handler($this);
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

            $id = [

                $this->_col_expiry => time()

            ];

            $this->_link->delete($this->_table,$id,false,'<');
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
        $id = [
            $this->_sess_id => $session_id,
        ];
        $this->_link->delete($this->_table,$id,false);

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

        $columns = [$this->_sess_data,$this->_col_expiry];
        $args = [
            $this->_sess_id => $session_id,
        ];

        $this->_link->select($this->_table,$columns,$args)->results(\PDO::FETCH_ASSOC);

        if($this->_link->getRowCount() === 0 )
        {
            $args = array_replace($args,[$this->_sess_data => "",$this->_col_expiry => $this->_expiry]);
            $this->_link->insert($this->_table,$args);
            return "";
        }

        $results = $this->_link->findFirst();

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

        $cols = [
            $this->_sess_id => $session_id,
            $this->_sess_data => $session_data,
            $this->_col_expiry => $this->_expiry,
        ];

        $updatable = [
            $this->_sess_data,

        ];

        $this->_link->insertUpdate($this->_table,$cols,$updatable);

        return true;
    }

    public function __destruct()
    {
        session_write_close();
    }

}