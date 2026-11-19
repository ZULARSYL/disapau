/**
* Model ▸ Login_model.php
* Asumsi: kolom password disimpan apa-adanya (plain-text)
*/
class Login_model extends BaseModel
{
public function getUser($username, $password)
{
$sql = "SELECT id_user, nama, id_level, jk, peringkat
FROM users
WHERE username = :username
AND password = :password
LIMIT 1";

$stmt = $this->db->prepare($sql);
$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);
$stmt->execute();

return $stmt->fetch(PDO::FETCH_ASSOC);
}
}