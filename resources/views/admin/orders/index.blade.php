<x-admin>
    <div class="container orders">
        <div class="header">
            <h1>Orders <span>({{ $orders->count() }})</span></h1>
            @include('partials.js_search')
        </div>

        <div class="body">
            <table>
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Names</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Shipping</th>
                        <th>Amount (Ksh)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $value)
                    <tr class="searchable">
                        <td>{{ $value->order_number }}</td>
                        <td>{{ $value->order_delivery->full_name }}</td>
                        <td>{{ $value->order_delivery->phone_number }}</td>
                        <td>{{ $value->order_delivery->address }}</td>
                        <td>{{ number_format($value->order_delivery->shipping_cost) }}</td>
                        <td>{{ number_format($value->total_amount) }}</td>
                        <td class="{{ $value->order_delivery->delivery_status == 'pending' ? 'text-danger' : 'text-success'  }}">{{ $value->order_delivery->delivery_status }}</td>
                        <td class="actions">
                            <div class="action">
                                <a href="{{ route('orders.edit', ['order'=>$value->id]) }}">
                                    <i class="fas fa-pencil-alt update"></i>
                                </a>
                            </div>
                            <div class="action">
                                <form id="deleteForm_{{ $value->id }}" action="{{ route('orders.destroy', ['order' => $value->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="javascript:void(0);" onclick="deleteItem({{ $value->id }}, 'order');">
                                        <i class="fas fa-trash-alt delete"></i>
                                    </a>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-sweetalert></x-sweetalert>
</x-admin>
