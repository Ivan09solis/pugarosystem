<?php
require_once '../conn/conn.php';
require_once '../includes/include.php';

// QUERY FOR ANNOUNCMENT LIST
$sql = "SELECT * FROM `event`  order by `id` DESC";
$event = mysqli_query($conn, $sql);

// QUERY FOR ANNOUNCMENT LIST
$sql = "SELECT * FROM `announcement`  order by `id` DESC";
$announcement = mysqli_query($conn, $sql);



?>


<head>
    <title>Events & Announcements</title>
</head>

<style type="text/css">
.navbar a.announcement {
    color: #00214D;
    background-color: white;
    box-shadow: 0px 0px 10px -3px rgba(0, 0, 0, 0.20);
}

.h2 {
    color: #00214D;
}

.nav-pills .nav-link.active,
.viewevent {
    background-color: #00214D;
    color: #fff;
}

.nav-pills .nav-link {
    background-color: white;
    color: #00214D;
    width: 300px;
}


.description {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Number of lines to show */
    -webkit-box-orient: vertical;
}

.description.expanded {
    display: block; /* Show full text */
}

.see-more {
    display: none; /* Hide "see more" link initially */
}

body {
            background-image: url('../includes/logo/bg1.png');
            background-size: cover;      
            background-position: center;  
            background-repeat: no-repeat; 
            height: 100vh;               
            margin: 0;                
        }


</style>

<body>
    <?php include('layout.php') ?>

    <div class="container mt-5">

        <div class="h2 fw-bold">Events & Announcements</div>


        <!-- CONTENT -->
        <div class=" mt-5">
            <div class="nav  nav-pills" id="nav-tab" role="tablist">
                <button class="nav-link active p-3 m-1 shadow rounded fw-bold" id="nav-home-tab" data-bs-toggle="tab"
                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                aria-selected="true">Events</button>
                <button class="nav-link p-3 shadow m-1 rounded fw-bold" id="nav-home2-tab" data-bs-toggle="tab"
                data-bs-target="#nav-home2" type="button" role="tab" aria-controls="nav-home2"
                aria-selected="false">Announcements</button>
            </div>


            <div class="tab-content mb-5" id="nav-tabContent">
                <!-- Event LIST -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">

                <!-- <div class="row"> -->
                    <!-- <div class="col-md-4 mt-5">
                            <div class="card round-2 mb-3 round" style="border-top: solid #00214D;">
                                <div class="card-body border-0">
                                    <div class="image-wrapper">
                                        <img src="../includes/logo/logo.gif" class="img-fluid">
                                        <div class="image-overlay">
                                        </div>
                                    </div>
                                    <div class="text-dark"><p class="h3 fw-bold mt-2">Resident's flkdsjfkdjdxjfnds kjfndskjfhdsu fydsiufhsi udfhsfufkjh </p><p class="mt-3"><i class="fa-solid fa-calendar"></i> August  20, 2024</p></div>
                                    <div class="mt-3 h5 text-dark">This is a text description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione nam saepe repellat vero. Quidem tempore necessitatibus, doloribus harum reprehenderit esse quibusdam? Accusantium suscipit magni, numquam facere minima nihil similique nesciunt.</div>
                                    <button class="btn viewevent shadow p-3 mt-5 mb-3 w-100 fw-bold text-center">VIEW DETAILS</buttonV>
                                </div>
                            </div> -->
                            <!-- </div> -->
                            <?php if ($event->num_rows > 0): ?>
                                <div class="row m-5">
                                    <?php while ($row = $event->fetch_assoc()): ?>
                                        <div class="col-md-4 ">
                                            <div class="card shadow-lg m-3 p-3">   
                                                <img class="img-fluid shadow rounded w-100 elevation-8" height="80" src="../includes/logo/<?= htmlspecialchars($row['img']); ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                                                <h3 class="mt-5 text-secondary mb-2"><?= htmlspecialchars($row['title']); ?></h3>
                                                <p><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($row['venue']); ?></p>
                                                <p class="mt-2 mb-2 minutes"><i class="fa-solid fa-calendar"></i> <?= htmlspecialchars($row['eventdate']); ?> &nbsp; | &nbsp;
                                                    <i class="fa-solid fa-clock"></i>
                                                    <?= date('h:i A', strtotime($row['from'])); ?> -
                                                    <?= date('h:i A', strtotime($row['to'])); ?>
                                                </p>

                                                <div class="w-100 mb-3 mt-3">
                                                    <p class="text-secondary fw-bold description" id="description-<?= $row['id']; ?>">
                                                        <?= htmlspecialchars($row['description']); ?>
                                                    </p>
                                                    <a href="#" class="text-primary see-more" id="see-more-<?= $row['id']; ?>">See more</a>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Announcement LIST -->
                        <div class="tab-pane fade  mt-5 " id="nav-home2" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <div class="row mt-5 ">
                            <div class="col-md-12">
                                <?php if ($announcement->num_rows > 0) {
                                    while ($row = $announcement->fetch_assoc()) {
                                        ?>
                                        <div class="text-center mt-5 fw-bold mb-3">
                                            <?= date('D, M j, Y', strtotime($row['updated_at'])); ?>
                                        </div>
                                        <div class="card round-2 mb-3 shadow round" style="border-top: solid #00214D;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between ">
                                                    <div class="h3"><?= $row['title']; ?> </div>
                                                    <div class="h6"><?= date('h:i A', strtotime($row['updated_at'])); ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div>
                                                            <p><?= $row['description']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        


        <script>
            function deleteR(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, I changed my mind'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../php/delete_reservation.php", {
                            id: id
                        },
                        function () {
                            Swal.fire({
                                title: 'Deleted Successfully',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        });
                    }
                })
            }
        </script>
    </body>
    <?php include('footer.php') ?>

    </html>