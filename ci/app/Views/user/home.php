<?php
function price(int $pri)
{
   $len =  mb_strlen($pri);
   if ($len == 4) {
       $end = substr($pri, -3);
       $first = substr($pri, 0, 1);
       return $first.','.$end;
   }elseif ($len == 3 ) {
    return $pri;
    }elseif ($len == 2 ) {
        return $pri;
    }elseif ($len == 1 ) {
        return $pri;
    } 
    elseif ($len == 5) {
        $end = substr($pri, -3);
        $first = substr($pri, 0, 2);
        return $first.','.$end;
        }
    elseif ($len == 6) {
        $end = substr($pri, -3);
        $first = substr($pri, 0, 3);
        return $first.','.$end;
        }elseif ($len == 7) {
            $end = substr($pri, -3);
            $mid = substr($pri, -6, 3);
            $first = substr($pri, 0, 1);
            return $first.','.$mid.','.$end;
            }elseif ($len == 8) {
                $end = substr($pri, -3);
                $mid = substr($pri, -6, 3);
                $first = substr($pri, 0, 2);
                return $first.','.$mid.','.$end;
                } 
}

?>
    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container pb-0">
        <!-- page content goes here -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container mt-4">
                    <div class="card border-0 shadow bg-default text-white">
                        <div class="card-body">
                            <p class="mb-2">Total Balance: <small class="text-mute">&#x20a6;<?= price($user['p_wallet'] + $user['c_wallet'])?></small></p>
                            <div class="row mb-2">
                                <div class="col">
                                    <p>Cash Wallet</p>
                                    <h1>&#x20a6;<?= price($user['c_wallet'])?></h1>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="progress bg-light-primary h-5 mb-2">
                                <div class="progress-bar bg-white" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                            <p>ID: <span class="text-mute"><?=$user['user_id'] ?> </span> <span class="float-right">Product Wallet: &#x20a6;<?=price($user['p_wallet']) ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="container mb-4 px-2">
                    <h6 class="page-subtitle">Top Products / Services
                        <p class="float-right"><a href="market">View all</a></p>
                    </h6>
                    
                    <div class="swiper-container swiper-offers">
                        <div class="swiper-wrapper">
                            <?php foreach ($products as $key => $prod): ?>
                            <div class="swiper-slide w-auto p-2">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <img class="" src="http://localhost/admin.master.terry/public/uploads/skillhubb/originals/<?= $prod['image']?>" height="150" alt="">
                                                <h6 class="mt-2  text-mute"><?= $prod['name'] ?></h6>
                                                <p>&#x20a6;<?= price($prod['price']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="container">
                    <h6 class="page-subtitle">My Downlines</h6>
                    <div class="card shadow-sm border-0 mb-4">
                        
                        <div class="card-body border-top">
                            <div class="media">
                                <figure class="icons icon-40 mr-2 bg-light-danger">
                                    <i class="material-icons">account</i>
                                </figure>
                                <div class="media-body">
                                    <h6 class="mb-1">David Ayo</h6>
                                    <p class="mb-0 text-mute small">&#x20a6; 32,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h6 class="page-subtitle">Quick Bills</h6>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1">$ 1048.00 </h5>
                                    <p class="text-mute small text-secondary mb-2">20d to pay electricity bill</p>
                                    <div class="progress h-5 bg-light-warning">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:35%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-44 default-shadow border-0 bg-default">
                                        <i class="material-icons">local_atm</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="font-weight-normal mb-1">$ 150.00 </h5>
                                    <p class="text-mute small text-secondary mb-2">5d to pay telephone bill</p>
                                    <div class="progress h-5 bg-light-danger">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width:80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center">
                                    <button class="btn btn-44 default-shadow border-0 bg-default">
                                        <i class="material-icons">local_atm</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </main>
    <!-- End of page content -->
