@extends('layouts.dashboard')

@section('content')

    @if (Auth::user()->isEmp == 0)
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Company</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-card--expand">
                    A company, abbreviated as co., is a legal entity representing an association of people, whether natural,
                    legal or a mixture of both, with a specific objective. Company members share a common purpose and unite
                    to achieve specific, declared goals.

                </div>
                <div class="mdl-card__actions">
                    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal pull-right"
                        href="{{ route('company') }}" target="_blank">
                        Edit
                    </a>
                </div>

            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Employee</h2>
                </div>
                <div class="mdl-card__supporting-text mdl-card--expand">
                    Employment is a relationship between two parties, usually based on contract where work is paid for,
                    where one party, which may be a corporation, for profit, not-for-profit organization, co-operative or
                    other entity is the employer and the other is the employee.

                </div>
                <div class="mdl-card__actions">
                    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal pull-right"
                        href="{{ route('employee') }}" target="_blank">
                        Edit
                    </a>
                </div>

            </div>
        </div>
    @else
        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">You don't have any access</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    You are currently log in as user. To access any feature please log in as admin.
                </div>
            </div>
        </div>
    @endif

@endsection
