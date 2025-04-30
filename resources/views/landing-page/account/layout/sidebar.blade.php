<style>
    .myaccount-tab-trigger {
        display: flex;
        justify-content: flex-start; /* Align items to the left */
        padding: 0;
    }

    .myaccount-tab-trigger .nav-item {
        margin: 0 5px; /* Reduce margin for smaller gap */
    }

    .myaccount-tab-trigger .nav-link {
        padding: 10px 15px;
        margin-bottom: 10px; /* Add margin below the buttons */
    }
</style>

<div class="col-lg-12">
    <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
        <li class="nav-item">
            <a href="{{ route('account.profile') }}" class="nav-link active" id="account-details-tab">Account Details</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('account.orders') }}" class="nav-link" id="account-orders-tab">Orders</a>
        </li>
    </ul>
</div>
