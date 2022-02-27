<h5 class="mt-3">สวัสดี คุณ... : <?php echo $_SESSION['login_name'];  ?></h5>



<div class="d-flex align-items-center mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <h5 class="card-header text-center">เพิ่มข้อมูลนักเรียน</h5>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">ชื่อ - นามสกุล</label>
                                <input type="text" name="student_name" id="student_name" class="form-control" placeholder="ชื่อ - นามสกุล">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="student_tel" id="student_tel" class="form-control" placeholder="เบอร์โทรศัพท์">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-mail Address</label>
                                <input type="email" name="student_email" id="student_email" class="form-control" placeholder="E-mail Address">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-success form-control insert_data">เพิ่มข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // insert data #############################################################
    $(document).on('click', '.insert_data', function() {
        var student_name = document.getElementById("student_name").value;
        var student_tel = document.getElementById("student_tel").value;
        var student_email = document.getElementById("student_email").value;

        // validate 
        if (student_name == "") {
            document.getElementById("student_name").focus();
        }else if(student_tel == ""){
            document.getElementById("student_tel").focus();
        }
        else if(student_email == ""){
            document.getElementById("student_email").focus();
        } 
        else {
            $.ajax({
                url: "app.php",
                method: "POST",
                data: {
                    program: "insert_data",
                    student_name: student_name,
                    student_tel: student_tel,
                    student_email: student_email
                },
                success: function(msg) {
                    if (msg == 'ok') {
                        Swal.fire(
                            'เพิ่มข้อมูลสำเร็จ!',
                            '',
                            'success'
                        ).then(function() {
                            window.location.href = "?pt=list_data";
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
        }
    });
</script>