<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public $Bonus = 7500;
    public $P_Bonus = 5250;
    public $C_Bonus = 2250;
    public function index()
    {
        $session = session();
        if ($session->logged_in == TRUE) {
            $session = session();
            $id = $session->id;
            $users = new \App\Models\Customers();
            $products = new \App\Models\Products();
            $prods = $products->findAll();
            foreach ($prods as $key => $value) {
                $prods[$key]['image'] = $this->getFile1($prods[$key]['image']);
            }

            $data = [
                'user' => $users->where('user_id', $id)->find()[0],
                'products' => $prods
            ];
            
            echo view('user/header');
            echo view('user/home', $data);
            echo view('user/footer');
        } else {
            $this->login();
        }
    }

    private function getFile($id) 
    {
        $client = \Config\Services::curlrequest();
        $url = 'http://localhost/admin.master.terry/skillhubb'.'/files/'.$id;
        $at = 'oIFIIgDji7AQ28TSNm4a3Ccm';
        $response = $client->request('GET', $url, ['query' => ['access_token' => $at]]);
        
        $body = json_decode($response->getBody());
        return $body->data->filename_disk;
    }

    private function getFile1($id) 
    {
        $files = new \App\Models\Files();
        $f_d = $files->where('id', $id)->find()[0];
        return $f_d['filename_disk'];
    }

    public function login()
    {
        echo view('user/authheader');
        echo view('user/login');
    }

    public function register()
    {
        echo view('user/authheader');
        echo view('user/register');
    }

    public function makePayment($id)
    {
        echo view('user/authheader');
        echo view('user/payment', ['id' => $id]);
    }

    public function postregister()
    {
        $users = new \App\Models\Customers();
        $incoming = $this->request->getPost();
        $ref_id = $incoming['ref'];
        $user_id = 'SH'.substr(uniqid(), -5) ;
        $ref_confirm = $users->where('user_id', $ref_id)->find();

        if (!empty($ref_confirm)) {
            $data = [
                'user_id' => $user_id,
                'fname' => $incoming['fname'],
                'lname' => $incoming['lname'],
                'email' => $incoming['email'],
                'phone' => $incoming['phone'],
                'sex' => $incoming['sex'],
                'address' => $incoming['address'],
                'paid' => 0,
                'ref_id' => $ref_id,
                'password' => hash('sha1', $incoming['pass'], false),
            ];

            if (null !== ($users->insert($data))) {
                $this->makePayment($user_id);
            } else {
                echo 'Not Successful';
            }
        } else {
            echo 'Invalid Referrer ID';
        }
    }

    public function postlogin()
    {
        $users = new \App\Models\Customers();
        $incoming = $this->request->getPost();
        $data = [
            'email' => $incoming['email'],
            'password' => hash('sha1', $incoming['pass'], false),
        ];
        $result = $users->where($data)->find();
        if ($result) {
            if ($result[0]['paid']) {
                $ses_data = [
                    'id' => $result[0]['user_id'],
                    'f_name' => $result[0]['fname'],
                    'email' => $result[0]['email'],
                    'paid' => $result[0]['paid'],
                    'logged_in' => TRUE,
                ];
                $session = session();
                $session->set($ses_data);
                $this->index();
            } else {
                $this->makePayment($result[0]['user_id']);
            }
        } else {
            echo 'Login not Successful';
        }
    }


    public function redir()
    {
        echo view('user/authheader');
        echo view('user/redirect');
    }

    public function processpay()
    {
        $users = new \App\Models\Customers();
        $incoming = $this->request->getGet();
        $data = [
            'paid' => 1
        ];
        
        $id = $incoming['sku'];
        $p_db = $users->where('user_id', $id)->find()[0];
        $users->update($id, $data);
        $this->addtowallet($p_db['ref_id']);
        $this->credit($id);
        $this->redir();
    }

    private function credit($id){
        $profit = new \App\Models\Profit();
        $data = [
            'customer' => $id,
            'amount' => 3500
        ];
        $profit->save($data);
        return;
    }

    private function addtowallet($id){
        $users = new \App\Models\Customers();
        $db_data = $users->where('user_id', $id)->find()[0];
        $data = [
            'p_wallet' => $db_data['p_wallet'] + $this->P_Bonus,
            'c_wallet' => $db_data['c_wallet'] + $this->C_Bonus,
        ];
        $users->update($id,$data);
        return;
        
    }

    public function transactions()
    {
        $session = session();
        if ($session->logged_in == TRUE) {
            echo view('user/header');
            echo view('user/transactions');
            echo view('user/footer');
        } else {
            $this->login();
        }
    }

    public function market()
    {
        $session = session();
        if ($session->logged_in == TRUE) {
            $id = $session->id;
            $users = new \App\Models\Customers();
            $products = new \App\Models\Products();
            $prods = $products->findAll();
            foreach ($prods as $key => $value) {
                $prods[$key]['image'] = $this->getFile1($prods[$key]['image']);
            }

            $data = [
                'user' => $users->where('user_id', $id)->find()[0],
                'products' => $prods
            ];
            echo view('user/header');
            echo view('user/market', $data);
            echo view('user/footer');
        } else {
            $this->login();
        }
    }

    public function about()
    {
        $session = session();
        if ($session->logged_in == TRUE) {
            echo view('user/header');
            echo view('user/about');
            echo view('user/footer');
        } else {
            $this->login();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        $this->login();
    }
    //--------------------------------------------------------------------

}
