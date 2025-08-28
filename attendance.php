<?php
require_once "database.php";

class Attendance extends Database {
    protected $table = "attendance";

    public function addAttendance($student_id, $date, $status) {
        return $this->create($this->table, [
            "student_id" => $student_id,
            "date" => $date,
            "status" => $status
        ]);
    }

    public function getAttendance() {
        return $this->read($this->table);
    }

    public function updateAttendance($id, $student_id, $date, $status) {
        return $this->update($this->table, [
            "student_id" => $student_id,
            "date" => $date,
            "status" => $status
        ], $id);
    }

    public function deleteAttendance($id) {
        return $this->delete($this->table, $id);
    }
}
