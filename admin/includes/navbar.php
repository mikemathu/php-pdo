<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Dashboard </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="members.php">Members<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="dapartments.php">Departments</a> -->
            <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Departments
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="dapartments.php">Departments</a>
    <a class="dropdown-item" href="department-add.php">ADD</a>
    <a class="dropdown-item" href="department-edit.php">Edit</a>
    <a class="dropdown-item" href="dapartment-delete.php">Delete</a>
  </div>
</div>
          </li>
        </ul>
      </div>
    </nav>
