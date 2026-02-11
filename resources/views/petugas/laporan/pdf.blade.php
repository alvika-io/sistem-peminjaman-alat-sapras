<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian - SMKN 1 CIOMAS</title>
    <style>
        /* Base Styling */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11px; 
            color: #334155; 
            margin: 0; 
            padding: 30px; 
        }
        
        /* Kop Surat Resmi Sekolah */
        .kop-surat {
            border-bottom: 3px double #1e293b;
            padding-bottom: 15px;
            margin-bottom: 25px;
            text-align: center;
        }
        .school-name { 
            font-size: 22px; 
            font-weight: 900; 
            color: #1e293b; 
            margin: 0;
            text-transform: uppercase;
        }
        .school-sub {
            font-size: 14px;
            font-weight: bold;
            color: #4f46e5;
            margin: 2px 0;
        }
        .address {
            font-size: 9px;
            color: #64748b;
            margin-top: 5px;
            font-style: italic;
        }

        /* Report Header */
        .report-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-header h2 {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 5px;
            color: #1e293b;
            text-transform: uppercase;
        }

        /* Info Section */
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 8px;
        }
        .info-label { color: #94a3b8; text-transform: uppercase; font-size: 8px; font-weight: bold; margin-bottom: 3px; }
        .info-value { font-size: 10px; font-weight: bold; color: #1e293b; }

        /* Main Table */
        table { width: 100%; border-collapse: collapse; }
        th { 
            background-color: #4f46e5; 
            color: #ffffff; 
            text-align: left; 
            text-transform: uppercase; 
            font-size: 9px; 
            font-weight: bold; 
            padding: 12px 10px; 
        }
        td { 
            padding: 10px; 
            border-bottom: 1px solid #e2e8f0; 
            color: #334155;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* Footer & Signature */
        .footer-wrapper {
            margin-top: 40px;
        }
        .summary-box { 
            float: right;
            width: 230px;
            background-color: #f8fafc; 
            padding: 15px; 
            border: 1px solid #e2e8f0;
            border-radius: 10px; 
            text-align: right; 
        }
        .total-amount { font-size: 18px; font-weight: 900; color: #4f46e5; margin-top: 5px; }
        
        .signature-area {
            margin-top: 50px;
            width: 250px;
            text-align: center;
        }
        .signature-space { margin-bottom: 60px; }
        .signature-line { font-weight: bold; text-decoration: underline; text-transform: uppercase; }

        .footer-note { 
            clear: both;
            margin-top: 80px; 
            text-align: center; 
            font-size: 8px; 
            color: #94a3b8; 
            border-top: 1px solid #f1f5f9; 
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <div class="school-name">SMK Negeri 1 Ciomas</div>
        <div class="school-sub">Sistem Peminjaman Sarana & Prasarana (SIPRAS)</div>
        <div class="address">
            Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610
        </div>
    </div>

    <div class="report-header">
        <h2>Laporan Rekapitulasi Pengembalian Alat</h2>
        <p style="font-size: 9px; color: #64748b;">ID Laporan: SPR/{{ date('Y') }}/{{ rand(1000, 9999) }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="border: none; padding: 0 10px 0 0; width: 50%;">
                <div class="info-box">
                    <div class="info-label">Periode Data</div>
                    <div class="info-value">
                        {{ request('tanggal_mulai') ? \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d/m/Y') : '-' }} 
                        - 
                        {{ request('tanggal_selesai') ? \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d/m/Y') : '-' }}
                    </div>
                </div>
            </td>
            <td style="border: none; padding: 0 0 0 10px; width: 50%;">
                <div class="info-box">
                    <div class="info-label">Waktu Cetak Dokumen</div>
                    <div class="info-value">{{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d F Y | H:i') }} WIB</div>
                </div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th>Nama Peminjam</th>
                <th class="text-center">Tgl Kembali</th>
                <th class="text-center">Kondisi</th>
                <th class="text-right">Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengembalians as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td style="font-weight: bold;">{{ $item->peminjaman->user->name }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_kembali_real)->format('d/m/Y') }}</td>
                <td class="text-center" style="text-transform: uppercase; font-size: 9px;">{{ $item->kondisi }}</td>
                <td class="text-right" style="font-weight: bold; color: {{ $item->denda > 0 ? '#ef4444' : '#10b981' }}">
                    Rp {{ number_format($item->denda, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 30px; color: #94a3b8;">Tidak ada data pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-wrapper">
        <div class="summary-box">
            <div style="font-size: 9px; font-weight: bold; color: #64748b;">TOTAL PENERIMAAN DENDA</div>
            <div class="total-amount">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
        </div>

        <div class="signature-area">
            <div style="margin-bottom: 50px;">Bogor, {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d F Y') }}</div>
            <p>Petugas Sapras SMKN 1 Ciomas,</p>
            <div class="signature-space"></div>
            <div class="signature-line">{{ auth()->user()->name }}</div>
            <p style="margin-top: 5px;">NIP. ..........................................</p>
        </div>
    </div>

    <div class="footer-note">
        Dokumen ini diterbitkan secara resmi melalui aplikasi SIPRAS SMKN 1 Ciomas.<br>
        Dicetak oleh: {{ auth()->user()->name }} | {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('H:i:s') }}
    </div>

</body>
</html>