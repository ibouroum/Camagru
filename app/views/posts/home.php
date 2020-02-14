<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
  
<div class="pagination justify-content-center">
  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php
    if($data['previousPage'] > 0)
      echo '<li class="page-item"><a class="page-link" href="'.URLROOT.'/posts/home?page='.$data['previousPage'].'">Previous</a></li>';
    else
      echo '<li class="page-item"><a class="page-link" >Previous</a></li>';
    

    
        for($i =1; $i <= $data['totalPages']; $i++){
          if($i == $data['currentPage'])
          {
            echo '<li class="page-item"><a class="page-link">'.$i.'</a></li>';
       
          }
           
          else
          {
            echo '<li class="page-item"><a class="page-link" href="'.URLROOT.'/posts/home?page='.$i.'">'.$i.'</a></li>';

          }
           
        }
      

    if($data['nextPage'] <= $data['totalPages'])
      echo '<li class="page-item"><a class="page-link" href="'.URLROOT.'/posts/home?page='.$data['nextPage'].'">Next</a></li>';
    else
      echo '<li class="page-item"><a class="page-link" >Next</a></li>';
    ?>
  </ul>
</nav>
</div>


<div class="row justify-content-center">
    <div class="col-md-6">
      <?php if(is_array($data['posts']))
                  {
       foreach($data['posts'] as $posts):?>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
              <div class="mr-4">
                <img class="rounded-circle" src="https://picsum.photos/id/350/50/50">
              </div>
              <div class="ml-2">
                <div class="h5 m-0"><?php echo $posts->username;?></div>
                <div class="h7 text-muted"><?php echo $posts->lastname . ' '. $posts->firstname;?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="text-muted h7 mb-2">
            <i class="fa fa-clock-o"></i><?php echo ' ' . $posts->created_at;?></div>
          
            <img src="<?php echo $posts->path;?>" class="img img-fluid" width="500" height="500" >
        
    
        </div>
        




    
       
       
      
        
             
             
               
            
          
            
          <div class="card-footer">

            <!-- like    -->
             <?php
          $liked = false;
          if(is_array($data['likes']))
                  {
          foreach ($data['likes'] as $like) {
            if ($like->like_user_id == $_SESSION['user_id'] && $like->like_post_id == $posts->posts_id) {
              $liked = true; ?>
              <i  onclick="like(event)"
                  class = "fas fa-heart"
                  data-post_id="<?php echo $posts->posts_id; ?>"
                  data-user_id="<?php echo $_SESSION['user_id']; ?>"
                  data-like_nbr="<?php echo $posts->like_nbr;?>"
                  id="li_<?php echo $posts->posts_id; ?>">
                    
              </i>
              <?php
                 }
             }
           }
             if ($liked === false) {?>
                 <i onclick="like(event)"
                 class = "far fa-heart"
                 data-post_id="<?php echo $posts->posts_id;  ?>"
                 data-like_nbr="<?php echo $posts->like_nbr;?>"
                 data-user_id="<?php echo $_SESSION['user_id']; ?>"
                 id="li_<?php echo $posts->posts_id ;?>"></i>
             <?php }
             ?>
             <a id="li_nb_<?php echo $posts->posts_id; ?>" class="h7 text-muted"><?php echo $posts->like_nbr ;?></a>
       
              <!-- comment    -->
            
              

          <a class="card-link"><i class="fa fa-comment"></i> Comments</a>

            
              <div class="cardbox-comments mt-2">            
              <textarea name="comment_<?php echo $posts->posts_id ;?>"
                        class="form-control w-100 mb-2" placeholder="Describe Post here..."
                        rows="1" >
                        </textarea>


              <button onclick="comment(event)"
                       data-c-user_id="<?php echo $_SESSION['user_id']; ?>"
                       data-c-post_id="<?php echo $posts->posts_id ;?>"
                       class="btn btn-secondary pull-right">Add
              </button>
                        
                          <br>
                        </div>
            
                      
              <?php
                if(is_array($data['comments']))
                  {
                    foreach($data['comments'] as $comment)
                      {
                        if($comment->post_id == $posts->posts_id)
                        {
                          ?>
                            <hr class="mb-1 mt-4">
                          <ul class="media-list">
                            <li class="media">                    
                              <div class="media-body">
                                
                                  
                                    <strong class="text-dark"><?php echo $comment->username;?></strong>
                                  
                                  
                                  
                                  <p><?php echo htmlspecialchars($comment->content);?></p>
                          
                                
                              </div>
                            </li>
                          </ul>
                              <?php
                            }
                          }
                        }?>                   
                              
      
   


          
          








          
       



          

          

  

            
          
          
          

          












         
          
         
          
          
        </div>
      </div>
      <br>
    <?php endforeach ;}?>
    </div>
  </div>
</div>
<br>
<br><br>















<?php require APPROOT . '/views/inc/footer.php'; ?>