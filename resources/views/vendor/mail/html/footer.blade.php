<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell" align="center" style="color:#555;font-size:12px;">
                    <p>
                        © {{ date('Y') }} {{ config('app.name') }}.
                        {{ __('app/mail.footer.rights_reserved') }}
                    </p>
                    <p>
                        {!! __('app/mail.footer.developed_by', [
                            'name' => '<a href="https://kodaxdigital.com" style="color:#2F3E50;">KODAX Digital</a>',
                        ]) !!}
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
