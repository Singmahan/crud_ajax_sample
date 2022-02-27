<?php
// session_start();
$sql = "SELECT `student_id`,`student_name`,`student_tel`,`student_email` FROM `student`";
$query = $condb->query($sql);

?>
<h5 class="mt-3">สวัสดี คุณ... : <?php echo $_SESSION['login_name'];  ?></h5>
<div class="d-flex align-items-center mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <h5 class="card-header text-center">แสดงข้อมูลนักเรียน</h5>
                    
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อ-นามสกุล</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <th class="text-center" scope="row"><?php echo $count = $count + 1; ?></th>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td class="text-center"><?php echo $row['student_tel']; ?></td>
                                        <td><?php echo $row['student_email']; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm edit_data" id="<?php echo $row['student_id']; ?>">แก้ไข</button>
                                            <button type="button" class="btn btn-danger btn-sm delete_data " id="<?php echo $row['student_id']; ?>">ลบ</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Data -->
<div class="modal fade" id="modal_edit_data" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">ชื่อ - นามสกุล</label>
                    <input type="text" name="student_name" id="student_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" name="student_tel" id="student_tel" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail Address</label>
                    <input type="email" name="student_email" id="student_email" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_data">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success save_edit_data">บันทึกข้อมูล</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // update -------------------------------------------------------- 3
    $(document).on('click', '.save_edit_data', function() {
        id_data = document.getElementById("id_data").value;
        student_name = document.getElementById("student_name").value;
        student_tel = document.getElementById("student_tel").value;
        student_email = document.getElementById("student_email").value;

        // alert(id_data);
        $.ajax({
            url: "app.php",
            method: "POST",
            data: {
                id_data: id,
                program: "save_edit_data",
                student_name:student_name,
                student_tel:student_tel,
                student_email:student_email
            },
            success: function(msg) {
                if (msg == 'ok') {
                    Swal.fire(
                        'อัพเดทข้อมูลสำเร็จ!',
                        '',
                        'success'
                    ).then(function() {
                        window.location.reload();
                    })
                } else {
                    Swal.fire(
                        'เกิดข้อผิดพลาด!',
                        'โปรดลองใหม่อีกครั้ง',
                        'error'
                    )
                }
            }
        });

    });
    // edit data -------------------------------------------------------- 2
    $(document).on('click', '.edit_data', function() {
        id = $(this).attr("id");
        $.ajax({
            url: "app.php",
            method: "POST",
            dataType: 'json',
            data: {
                student_id: id,
                program: "edit_data"
            },
            success: function(msg) {
                // console.log(msg);
                // ดึงข้อมูลมาแสดงในฟอร์มแก้ไข 
                student_name = msg[0]['student_name'];
                student_tel = msg[0]['student_tel'];
                student_email = msg[0]['student_email'];

                document.getElementById("student_name").value = student_name;
                document.getElementById("student_tel").value = student_tel;
                document.getElementById("student_email").value = student_email;
                document.getElementById("id_data").value = id;

                $("#modal_edit_data").modal('show');
            }
        });


    });
    // delete data ------------------------------------------------------------------ 1
    $(document).on('click', '.delete_data', function() {
        id = $(this).attr("id");
        Swal.fire({
            title: 'ยืนยันการลบรายชื่อนี้ใช่หรือไม่ ?',
            text: "ลบรายชื่อนี้จะไม่สามารถกู้คืนได้อีก",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบรายการ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "app.php",
                    method: "POST",
                    data: {
                        id: id,
                        program: "delete_data"
                    },
                    success: function(msg) {
                        if (msg == 'ok') {
                            Swal.fire(
                                'ลบรายการสำเร็จ!',
                                '',
                                'success'
                            ).then(function() {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire(
                                'เกิดข้อผิดพลาด!',
                                'โปรดลองใหม่อีกครั้ง',
                                'error'
                            )
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'รายการได้รับการยกเลิก',
                    '',
                    'error'
                )
            }
        })
        return false;
    });
</script>