<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Year</th>
            <th>Month</th>
            <th>Sales</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @if ($month_label != 0)
            @for ($i = 0; $i < count($month_label); $i++)
                <tr>
                    <td>{{ $year }}</td>
                    <td>{{ $month_label[$i] }}</td>
                    <td style="text-align: right">{{ $monthly_total_sales[$i] }}</td>
                    <td><a target="_blank" href="{{ url('monthly_earning_view_sales_report',['month' => $month[$i]]) }}">View Sales Report</a></td>
                </tr>
            @endfor
        @else
                <tr>
                    <td colspan="4" style="text-align: center">NO DATA FOUND!</td>
                </tr>
        @endif
    </tbody>
</table>
