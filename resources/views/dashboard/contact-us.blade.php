<!-- resources/views/dashboard/sliders.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>رسائل العملاء</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>اسم العميل </th>
                        <th>رقم العميل </th>
                        <th>البريد الالكتروني</th>
                        <th>الحجم</th>
                        <th>الوزن</th>
                        <th>عدد الكراتين</th>
                        <th>نوع البضاعة</th>
                        <th>منطقة الاستلام</th>
                        <th>منطقة التسليم</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->user->name }}</td>
                            <td>{{ $contact->user->phone }}</td>
                            <td>{{ $contact->user->email }}</td>
                            <td>{{ $contact->size }}</td>
                            <td>{{ $contact->weight }}</td>
                            <td>{{ $contact->cartonsCount }}</td>
                            <td>{{ $contact->goodsType }}</td>
                            <td>{{ $contact->pickupLocation }}</td>
                            <td>{{ $contact->deliveryLocation }}</td>
                            <td>
                                <form action="{{ route('contact-us.delete', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
