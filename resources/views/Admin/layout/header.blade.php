<header class="admin-header">

    <div class="header-title">
        <h2>RoadCare Admin</h2>
    </div>


    <div class="admin-user">

        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>


        <span>
            {{ Auth::user()->name }}
        </span>

    </div>

</header>


<style>

.admin-header {

    height: 70px;

    background: white;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 30px;

    border-bottom: 1px solid #e5e7eb;

    box-shadow: 0 2px 8px rgba(0,0,0,0.05);

}



.header-title h2 {

    margin: 0;

    font-size: 22px;

    font-weight: 700;

    color: #111827;

}



.admin-user {

    display: flex;

    align-items: center;

    gap: 12px;

    font-size: 15px;

    font-weight: 600;

    color: #374151;

}



.avatar {

    width: 40px;

    height: 40px;

    border-radius: 50%;

    background: #2563eb;

    color: white;

    display: flex;

    justify-content: center;

    align-items: center;

    font-weight: bold;

    font-size: 17px;

}

</style>