<?php
function price(int $pri)
{
    $len =  mb_strlen($pri);
    if ($len == 4) {
        $end = substr($pri, -3);
        $first = substr($pri, 0, 1);
        return $first . ',' . $end;
    } elseif ($len == 3) {
        return $pri;
    } elseif ($len == 2) {
        return $pri;
    } elseif ($len == 1) {
        return $pri;
    } elseif ($len == 5) {
        $end = substr($pri, -3);
        $first = substr($pri, 0, 2);
        return $first . ',' . $end;
    } elseif ($len == 6) {
        $end = substr($pri, -3);
        $first = substr($pri, 0, 3);
        return $first . ',' . $end;
    } elseif ($len == 7) {
        $end = substr($pri, -3);
        $mid = substr($pri, -6, 3);
        $first = substr($pri, 0, 1);
        return $first . ',' . $mid . ',' . $end;
    } elseif ($len == 8) {
        $end = substr($pri, -3);
        $mid = substr($pri, -6, 3);
        $first = substr($pri, 0, 2);
        return $first . ',' . $mid . ',' . $end;
    }
}

?>
<!-- Begin page content -->
<main class="flex-shrink-0 main-container">
    <!-- page content goes here -->
    <div class="container my-4">
        <!-- <div class="form-group">
                <input type="text" class="form-control datepicker" placeholder="Select Date">
            </div> -->
    </div>
    <div class="container">
        <h6 class="page-subtitle">Market</h6>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row">
                    <?php foreach ($products as $key => $prod) : ?>
                        <div class="col-6 col-md-4 col-lg-3 p-1">
                                <a href="#!">
                            <div class="shadow card overflow-hidden border-0">
                                <div class="card-img p-1">
                                    <img class="" src="http://localhost/admin.master.terry/public/uploads/skillhubb/originals/<?= $prod['image'] ?>" height="150" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-normal my-0"><a href="#!"><?= $prod['name'] ?></a></h5>
                                    <p><span class="float-right">&#x20a6;<?= price($prod['price']) ?></span></p>
                                </div>
                                
                            </div></a>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </div>
</main>
<!-- End of page content -->