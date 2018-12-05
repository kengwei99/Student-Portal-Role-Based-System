<?php


class paginate
{
    private $db;
 
    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
 
    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
 
        if($stmt->rowCount()>0)
        {
            while($post=$stmt->fetch(PDO::FETCH_ASSOC))
            {
            ?>
                <div class="col-sm-6 col-md-3 col-lg-3 mt-4">
                    <div class="card card-inverse card-info">
                        <img class="card-img-top" src="../assets/img/creativity.png">
                        <div class="card-block">
                            <h4 class="card-title"><?php echo $post['Idea_Title']; ?></h4>
                            <div class="card-text">
                                <?php echo substr($post['Idea_Description'],0,50); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <i <?php if (userLiked($post['Idea_ID'])):?> class="fa fa-thumbs-up like-btn"<?php else: ?>
                              class="fa fa-thumbs-o-up like-btn"<?php endif ?> data-id="<?php echo $post['Idea_ID'] ?>"> </i>
                            <span class="likes"><?php echo getLikes($post['Idea_ID']); ?></span>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i <?php if (userDisliked($post['Idea_ID'])): ?> class="fa fa-thumbs-down dislike-btn"<?php else:?> class="fa fa-thumbs-o-down dislike-btn"<?php endif ?> data-id="<?php echo $post['Idea_ID'] ?>"></i>
                            <span class="dislikes"><?php echo getDislikes($post['Idea_ID']); ?></span>
                            <a class="btn btn-info btn-xs pull-right read-more" href="single-idea.php?id=<?php echo $post['Idea_ID']; ?>">Read More</a>
                        </div>
                    </div>
                    <br/>
                </div>
            <?php
            }
        }
        else
        {
            ?>
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                No Idea avaiable.
            </div>
            <?php
        }
  
    }
 
    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
             $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }
 
    public function paginglink($query,$records_per_page)
    {
  
        $self = $_SERVER['PHP_SELF'];
  
        $stmt = $this->db->prepare($query);
        $stmt->execute();
  
        $total_no_of_records = $stmt->rowCount();
  
        if($total_no_of_records > 0)
        {
            ?>
            <ul class="pagination">
            <?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"]))
            {
               $current_page=$_GET["page_no"];
            }
            if($current_page!=1)
            {
               $previous =$current_page-1;
               echo "<li><a href='".$self."?page_no=1'>First</a></li>";
               echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++)
            {
                if($i==$current_page)
                {
                    echo "<li class='active'><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
                else
                {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages)
            {
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }
}

?>