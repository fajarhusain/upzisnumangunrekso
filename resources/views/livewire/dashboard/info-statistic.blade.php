<div class="space-y-6">
    <x-card.app>
        <div class="relative mt-6 overflow-auto rounded-md">
            <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th rowspan="2">
                            No.
                        </th>
                        <th rowspan="2">
                            Nama sumber Saldo
                        </th>
                        <th colspan="3" class="">
                            saldo
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Zakat
                        </th>
                        <th>
                            Infaq
                        </th>
                        <th>
                            Amil
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kas Tunai Zakat</td>
                        <td>
                            {{ $saldoTunaiZakat }}
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kas Bsi Zakat</td>
                        <td>
                            {{ $saldoBsiZakat }}
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kas BPD DIY Zakat</td>
                        <td>
                            {{ $saldoBpddiyZakat }}
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kas Tunai Infaq</td>
                        <td>
                            {{ $saldoTunaiInfaq }}
                        </td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kas BSI Infaq</td>
                        <td>-</td>
                        <td>
                            {{ $saldoBsiInfaq }}
                        </td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Kas BPD DIY Infaq</td>
                        <td>-</td>
                        <td>
                            {{ $saldoBpddiyInfaq }}
                        </td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Kas Muamalat Infaq</td>
                        <td>-</td>
                        <td>
                            {{ $saldoMuamalatInfaq }}
                        </td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Kas Madina Infaq</td>
                        <td>-</td>
                        <td>
                            {{ $saldoMadinaInfaq }}
                        </td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Kas Bank Amil</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            {{ $saldoBankAmil }}
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Kas Besar Amil</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            {{ $saldoBesarAmil }}
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Kas Kecil Amil</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            {{ $saldoKecilAmil }}
                        </td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Kas Madina Amil</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            {{ $saldoMadinaAmil }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td rowspan="3">Total Zakat & Infaq</td>
                        <td>{{ $totalZakat }}</td>
                        <td>{{ $totalInfaq }}</td>
                        <td>{{ $totalAmil }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"> {{ $totalZakatInfaq }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">{{ $totalSemua }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-card.app>
    <x-card.app>
        <div class="relative mt-6 overflow-auto rounded-md">
            <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th rowspan="3">
                            No.
                        </th>
                        <th>
                            Nama Akun
                        </th>
                        <th>
                            Target
                        </th>
                        <th>
                            Realisasi
                        </th>
                        <th>
                            Realisasi sub Pilar
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2">
                            Zakat
                        </th>
                        <th rowspan="2">
                            360
                        </th>
                        <th rowspan="2">
                            persen%
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Zakat Maal
                        </td>
                        <td>

                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-card.app>
</div>
