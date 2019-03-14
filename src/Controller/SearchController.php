<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SearchController extends AppController
{
    public function index()
    {
        $jobs = [];
        if($this->request->query('find')){
            $find = urlencode($this->request->query('find'));
            $url = env('SOLA_REMOTE');
            $url = "{$url}?q=title:{$find}+OR+subtitle:{$find}+OR+explanation:{$find}+OR+access:{$find}+OR+employmentStatus:{$find}+&+rows=100000";

            $data = ['url_name' => $url];
            $content = http_build_query($data);
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
            );
            $options = array('http' => array(
                'method' => 'get',
                'content' => $content,
                'header' => implode("\r\n", $headers)
            ));
            $contents = file_get_contents($url, false, stream_context_create($options));
            $jobs = json_decode($contents)->response;
        }
        $this->set(compact('jobs', 'find'));
    }


}
