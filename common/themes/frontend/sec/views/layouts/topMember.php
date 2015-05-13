<div name="login-form" class="login-form" >
    <div class="header2">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Member Baru</a></li>
            <li class=""><a href="#profile" data-toggle="tab">Moderator</a></li>

        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <ul class="member">
                    <?php
                    $member = BbiiMember::model()->findAll(array('order' => 'id desc', 'limit' => 6));
                    foreach ($member as $tt) {
                        echo'<li><a href="' . url('forum/member/view', array('id' => $tt->id)) . '"><img class="img-polaroid img-responsive" src="' . $tt->imgUrl['small'] . '" style="width:70px;height:75px" title="' . $tt->member_name . ' - ' . $tt->business->name . '"></a></li>';
                    }
                    ?>


                </ul>
            </div>
            <div class="tab-pane fade" id="profile">
                <ul class="member">
                    <?php
                    $moderator = BbiiMember::model()->findAll(array('order' => 'rand()', 'limit' => 6, 'condition' => 'moderator=1'));
                    foreach ($moderator as $tt) {
                        echo'<li><a href="' . url('forum/member/view', array('id' => $tt->id)) . '"><img class="img-polaroid img-responsive" src="' . $tt->imgUrl['small'] . '" style="width:70px;height:75px" title="' . $tt->member_name . '"></a></li>';
                    }
                    ?>


                </ul>
            </div>

        </div>





    </div>
</div>
