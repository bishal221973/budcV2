<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #app,body{
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden;
        /* background-color: #f7f7f7; */
        background-color: #004e64;
    }
    .main-login-container{
        background-color: #3d748c;
        height: 100vh;
        width: 100vw;
    }
    .login-description{
        background-color: #0d4d6c;
        padding-right: 60px !important;
        /* border-bottom-left-radius: 20px; */
    }
    .login-border{
        border-radius: 20px;
        overflow: hidden;
    }
    .login-container{
        position: relative;
        left: -50px;
        width: calc(100% + 50px);
        border-radius: 20px;
        padding-left: 40px !important;
    }

    .input-section{
        border:1px solid #ccc;
        padding: 5px 10px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .input-section input{
        width: 100%;
        border:none;
        outline: none;
    }

    .sidebar-contaoner{
        min-width: 250px;
        max-width: 250px;
        background-color: #fff;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        height: calc(100vh - 8px);
        border-radius: 20px;
    }
    .main{
        width: 100%;
    }



    .sidebar {
        width: 100%;
        height: 100vh;
        color: white;
        overflow-y: auto;
    }

    .sidebar-header {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid #0b6b83;
    }

    .logo {
        max-width: 100%;
        height: auto;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        position: relative;
    }

    .sidebar-menu a,
    .sidebar-menu label {
        display: block;
        padding: 12px 20px;
        color: #000;
        text-decoration: none;
        transition: background 0.3s;
    }

    .sidebar-menu a:hover,
    .sidebar-menu label:hover {
        background-color: #016f8f;
        color: #fff;
    }

    .sidebar-menu i {
        /* margin-right: 10px; */
    }

    input[type="checkbox"] {
        display: none;
    }

    .submenu {
        display: none;
        background-color: #3d748c;
        padding: 0;
        margin: 0;
        width: 100%;
    }

    input[type="checkbox"]:checked~.submenu {
        display: block;
    }

    .submenu li a {
        color: #fff;
        padding: 12px 30px;
        background-color: #3d748c;
    }

    .submenu li a:hover {
        background-color: #3d748c;
    }

    .arrow::after {
        content: '▸';
        float: right;
        transition: transform 0.3s;
    }

    input[type="checkbox"]:checked+label .arrow::after {
        transform: rotate(90deg);
    }

    .sidebar-menu li.has-submenu {
        margin: 0;
        padding: 0;
    }

    .sidebar-menu label {
        display: block;
        padding: 12px 20px;
        margin: 0;
    }

    .submenu {
        display: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    input[type="checkbox"]:not(:checked)~.submenu {
        display: none;
        height: 0;
        overflow: hidden;
    }

    input[type="checkbox"]:checked + label {
    background-color: #004e64; /* Highlight active parent item */
    color: #ffffff;
}

input[type="checkbox"]:checked + label i {
    color: #ffffff;
}


.main-card{
    height: calc(100vh - 70px);
    overflow-x: auto;
}
</style>
