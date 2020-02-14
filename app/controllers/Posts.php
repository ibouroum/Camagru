<?php
class Posts extends Controller{
    public function __construct(){
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index(){
        redirect('posts/home');
    }

    public function home(){
      

        $postsPerPage = 5;
    $totalPosts = $this->postModel->count_posts();
    $totalPages = ceil($totalPosts/$postsPerPage);
    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPages){
     $_GET['page'] = intval($_GET['page']);
     $currentPage = $_GET['page'];
   }else
     $currentPage = 1;
   $depart = ($currentPage - 1) * $postsPerPage;
     $posts = $this->postModel->getPosts($depart, $postsPerPage);
     $likes = $this->postModel->getlikes();
     $comments = $this->postModel->getcomments();

     $data =[
        'likes' => $likes,
        'comments' => $comments,
       'posts' => $posts,
       'totalPages' => $totalPages,
       'currentPage' => $currentPage,
       'depart' => $depart,
       'previousPage' => $currentPage - 1,
       'nextPage' => $currentPage + 1
     ];

     $this->view('posts/home',$data);
        
    
 }

 
    
    public function image(){
      if($this->userModel->findUserById()){

        if(isloggedIn())
        {
            $data = $this->postModel->getpost($_SESSION['user_id']);
            $this->view("posts/image",$data);
        }
        else
            redirect("users/login");
        
        } else
            logout();
        
    }
    public function s_image(){
        if(isset($_POST['imgBase64']) && isset($_POST['emoticon']))
        {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $upload_dir = "../public/img/";

            $img = $_POST['imgBase64'];
            $emo = $_POST['emoticon'];
            
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $da = base64_decode($img);
            $file = $upload_dir.mktime().'.png';
            file_put_contents($file, $da);

            list($srcWidth, $srcHeight) = getimagesize($emo);
            $src = imagecreatefrompng($emo);
            $dest = imagecreatefrompng($file);
            imagecopy($dest, $src, 0,0, 0, 0, $srcWidth, $srcHeight);
            imagepng($dest, $file, 9);
            move_uploaded_file($dest, $file);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'path' => $file
            ];
            if($this->postModel->save($data))
            {
            
            }
            else
                return false;
        }
        else
          redirect('posts/home');
       
    }


    public function comment()
    {
      if($this->userModel->findUserById()){

        if(isloggedIn() && isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['content']))
        {
            $po = $this->postModel->getUserByPostId($_POST['post_id']);
            $data = [
               'post_id'=> $_POST['post_id'],
               'user_id' => $_POST['user_id'],
               'content' => $_POST['content'],
               'user_comment' => $this->postModel->getUserById($_POST['user_id']),
               'user_post' => $this->postModel->getUserById($po)
           ];


           if($this->postModel->addcomment($data) && strlen($data['content'] <= 255))
           {
                if($data['user_post']->notif == 0)
                {
                  comment_sent_email($data);
                }
           }
           else
            die('!base donne');

        }
        else
          redirect('posts/home');
        
        } else
            logout();
        
    }
    public function Like(){
      if($this->userModel->findUserById()){

        if(isloggedIn() && isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['c']) && isset($_POST['like_nbr']))
       {
           $data = [
               'post_id'=> $_POST['post_id'],
               'user_id' => $_POST['user_id'],
               'c' => $_POST['c'],
               'like_nbr' => $_POST['like_nbr']
           ];
            $this->postModel->like_nbr($data);
           if($data['c'] == 'fas fa-heart')
           {
             if($this->postModel->deleteLike($data))
             {
                }
             else
             {
               die('wa noud');
             }
           }
           else if($data['c'] == 'far fa-heart')
           {
             if($this->postModel->addLike($data))
             {

             }
             else
             {
               die('wa noud');
             }
           }
       }
       else
          redirect('posts/home');
        
        } else
           logout();
       
   }

  
    public function deletePost()
    {
        $data = $this->postModel->getpost($_SESSION['user_id']);
        if(isset($_POST['submit']))
         {
            $postId = $_POST['postId'];

            if($this->postModel->deletePost($postId, $_SESSION['user_id']))
            {
                redirect('users/profile');
            }
            else
                die('nono');
              $this->view('users/profile',$data);
        }
        else
          redirect('posts/home');
        
    }
    


}