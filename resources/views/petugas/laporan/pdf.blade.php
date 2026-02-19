<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian - SMKN 1 CIOMAS</title>
    <style>
        /* Base Styling */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 10px; 
            color: #334155; 
            margin: 0; 
            padding: 20px; 
        }
        
        /* Kop Surat Resmi Sekolah */
        .kop-surat {
            border-bottom: 2px solid #1e293b;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .school-name { 
            font-size: 20px; 
            font-weight: 900; 
            color: #1e293b; 
            margin: 0;
            text-transform: uppercase;
        }
        .school-sub {
            font-size: 12px;
            font-weight: bold;
            color: #4f46e5;
            margin: 2px 0;
        }
        .address {
            font-size: 8px;
            color: #64748b;
            margin-top: 5px;
            font-style: italic;
        }

        /* Report Header */
        .report-header {
            text-align: center;
            margin-bottom: 25px;
        }
        .report-header h2 {
            font-size: 13px;
            margin-bottom: 5px;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Info Section */
        .info-table { width: 100%; margin-bottom: 15px; border: none; }
        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px;
            border-radius: 6px;
        }
        .info-label { color: #94a3b8; text-transform: uppercase; font-size: 7px; font-weight: bold; margin-bottom: 2px; }
        .info-value { font-size: 9px; font-weight: bold; color: #1e293b; }

        /* Main Table */
        table { width: 100%; border-collapse: collapse; }
        th { 
            background-color: #f1f5f9; 
            color: #475569; 
            text-align: left; 
            text-transform: uppercase; 
            font-size: 8px; 
            font-weight: bold; 
            padding: 10px; 
            border: 1px solid #e2e8f0;
        }
        td { 
            padding: 8px 10px; 
            border: 1px solid #e2e8f0; 
            color: #334155;
            vertical-align: top;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge {
            font-size: 7px;
            padding: 2px 5px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-rusak { background-color: #fef2f2; color: #dc2626; }
        .badge-hilang { background-color: #450a0a; color: #ffffff; }
        .badge-baik { background-color: #f0fdf4; color: #16a34a; }

        /* Footer & Signature */
        .footer-wrapper {
            margin-top: 30px;
        }
        .summary-wrapper {
            float: right;
            width: 250px;
        }
        .summary-row {
            padding: 5px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 9px;
        }
        .total-row {
            background-color: #4f46e5;
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            text-align: right;
        }
        
        .signature-area {
            margin-top: 30px;
            width: 200px;
            text-align: center;
        }
        .signature-space { height: 60px; }
        .signature-line { font-weight: bold; border-bottom: 1px solid #000; display: inline-block; padding: 0 20px; text-transform: uppercase; }

        .footer-note { 
            clear: both;
            margin-top: 50px; 
            text-align: center; 
            font-size: 7px; 
            color: #94a3b8; 
            border-top: 1px solid #f1f5f9; 
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <div class="school-name">SMK Negeri 1 Ciomas</div>
        <div class="school-sub">Unit Sarana & Prasarana - SIPRAS Reporting</div>
        <div class="address">
            Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610
        </div>
    </div>

    <div class="report-header">
        <h2>Rekapitulasi Pengembalian & Denda Alat</h2>
        <p style="font-size: 8px; color: #64748b;">No. Dokumen: SPR/{{ date('Ymd') }}/{{ strtoupper(Str::random(5)) }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="border: none; padding: 0 10px 0 0; width: 50%;">
                <div class="info-box">
                    <div class="info-label">Periode Laporan</div>
                    <div class="info-value">
                        {{ request('tanggal_mulai') ? \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') : 'Awal' }} 
                        s/d 
                        {{ request('tanggal_selesai') ? \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d M Y') : 'Sekarang' }}
                    </div>
                </div>
            </td>
            <td style="border: none; padding: 0 0 0 10px; width: 50%;">
                <div class="info-box">
                    <div class="info-label">Dicetak Oleh</div>
                    <div class="info-value">{{ auth()->user()->name }} | {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</div>
                </div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 20px;">No</th>
                <th>Peminjam</th>
                <th>Alat & Jumlah</th>
                <th class="text-center">Tgl Kembali</th>
                <th class="text-center">Kondisi</th>
                <th class="text-right">Denda</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengembalians as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <div style="font-weight: bold;">{{ $item->peminjaman->user->name }}</div>
                    <div style="font-size: 7px; color: #94a3b8;">UID: {{ $item->peminjaman->user->id }}</div>
                </td>
                <td>
                    @foreach($item->peminjaman->alats as $alat)
                        <div style="margin-bottom: 2px;">• {{ $alat->nama }} ({{ $alat->pivot->jumlah }} unit)</div>
                    @endforeach
                </td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_kembali_real)->format('d/m/Y') }}</td>
                <td class="text-center">
                    <span class="badge badge-{{ $item->kondisi }}">
                        {{ $item->kondisi }}
                    </span>
                </td>
                <td class="text-right" style="font-weight: bold;">
                    Rp {{ number_format($item->denda, 0, ',', '.') }}
                </td>
                <td class="text-center" style="font-size: 7px; font-weight: bold; color: {{ $item->denda_status == 'lunas' ? '#16a34a' : '#ea580c' }}">
                    {{ strtoupper($item->denda_status) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 30px; color: #94a3b8;">Data tidak ditemukan pada kriteria filter ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-wrapper">
        <div class="signature-area" style="float: left;">
            <div style="margin-bottom: 10px;">Mengetahui,</div>
            <p>Petugas Sarana Prasarana,</p>
            <div class="signature-space"></div>
            <div class="signature-line">{{ auth()->user()->name }}</div>
            <p style="margin-top: 5px; font-size: 8px;">NIP. ..........................................</p>
        </div>

        <div class="summary-wrapper">
            <div class="summary-row">
                <span style="color: #64748b;">Total Denda Terbayar (Lunas)</span>
                <span style="float: right; font-weight: bold; color: #16a34a;">Rp {{ number_format($pengembalians->where('denda_status', 'lunas')->sum('denda'), 0, ',', '.') }}</span>
            </div>
            <div class="summary-row" style="border-bottom: none;">
                <span style="color: #64748b;">Total Piutang (Belum Bayar)</span>
                <span style="float: right; font-weight: bold; color: #ea580c;">Rp {{ number_format($pengembalians->where('denda_status', 'belum_dibayar')->sum('denda'), 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <div style="font-size: 7px; text-transform: uppercase; opacity: 0.8;">Akumulasi Seluruh Denda</div>
                <div style="font-size: 16px; font-weight: 900;">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="footer-note">
        Dokumen ini sah dan diterbitkan secara otomatis oleh Sistem Informasi Sarana Prasarana (SIPRAS) SMK Negeri 1 Ciomas.<br>
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>

</body>
</html>