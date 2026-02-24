<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    .page-wrap {
        max-width: 720px;
        margin: 48px auto;
        padding: 0 16px;
        font-family: 'IBM Plex Sans', sans-serif;
        color: #111;
        animation: up 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes up {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Header ── */
    .page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 28px;
        gap: 16px;
    }

    .header-left {}

    .brand {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .brand-mark {
        width: 28px; height: 28px;
        background: #111;
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
    }

    .brand-mark svg {
        width: 14px; height: 14px;
        stroke: #fff; fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    .brand-label {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.7rem;
        color: #aaa;
        letter-spacing: 0.08em;
    }

    .page-header h2 {
        font-size: 1.3rem;
        font-weight: 500;
        letter-spacing: -0.02em;
        margin-bottom: 5px;
    }

    .page-header .sub {
        font-size: 0.82rem;
        color: #999;
        font-weight: 300;
    }

    .btn-add {
        padding: 9px 16px;
        background: #111;
        color: #f5f5f3;
        border: none;
        border-radius: 5px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        white-space: nowrap;
        display: flex; align-items: center; gap: 6px;
        transition: background 0.15s;
        flex-shrink: 0;
    }

    .btn-add svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    .btn-add:hover { background: #2a2a2a; color: #f5f5f3; }

    /* ── Card ── */
    .table-card {
        background: #fff;
        border: 1px solid #e2e2e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
        position: relative;
    }

    .table-card::before {
        content: '';
        position: absolute;
        top: 0; left: 24px; right: 24px;
        height: 2px;
        background: #111;
        border-radius: 0 0 2px 2px;
    }

    /* ── Table ── */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        border-bottom: 1px solid #f0f0ee;
    }

    thead th {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.68rem;
        color: #aaa;
        font-weight: 400;
        letter-spacing: 0.06em;
        padding: 14px 20px;
        text-align: left;
    }

    thead th:first-child { width: 52px; }
    thead th:last-child { width: 120px; text-align: right; }

    tbody tr {
        border-bottom: 1px solid #f5f5f3;
        transition: background 0.1s;
    }

    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #fafaf9; }

    tbody td {
        padding: 13px 20px;
        font-size: 0.88rem;
        color: #111;
        vertical-align: middle;
    }

    tbody td:first-child {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.72rem;
        color: #ccc;
    }

    tbody td:last-child {
        text-align: right;
    }

    /* ── Row actions ── */
    .row-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 4px;
    }

    .btn-edit {
        padding: 5px 12px;
        background: transparent;
        color: #666;
        border: 1px solid #e2e2e0;
        border-radius: 4px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.76rem;
        text-decoration: none;
        transition: border-color 0.15s, color 0.15s;
    }

    .btn-edit:hover { border-color: #aaa; color: #111; }

    .btn-delete {
        padding: 5px 12px;
        background: transparent;
        color: #b94040;
        border: 1px solid #edc8c8;
        border-radius: 4px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.76rem;
        cursor: pointer;
        transition: background 0.15s, color 0.15s, border-color 0.15s;
    }

    .btn-delete:hover {
        background: #fdf5f5;
        border-color: #d09090;
    }

    /* ── Empty state ── */
    .empty-state {
        padding: 48px 20px;
        text-align: center;
        color: #bbb;
        font-size: 0.85rem;
    }

    .empty-state svg {
        width: 32px; height: 32px;
        stroke: #ddd; fill: none;
        stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        margin: 0 auto 12px;
        display: block;
    }

    /* ── Footer count ── */
    .table-footer {
        padding: 12px 20px;
        border-top: 1px solid #f0f0ee;
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.7rem;
        color: #bbb;
        letter-spacing: 0.04em;
    }
</style>

<div class="page-wrap">
    <div class="page-header">
        <div class="header-left">
            <div class="brand">
                <div class="brand-mark">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <span class="brand-label">PORTAL PEGAWAI</span>
            </div>
            <h2>Daftar Departemen</h2>
            <p class="sub">Kelola unit dan divisi organisasi</p>
        </div>

        <a href="/departments/new" class="btn-add">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah
        </a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama departemen</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($departments)): ?>
                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                            Belum ada departemen
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                <?php $no = 1; foreach ($departments as $dept): ?>
                <tr>
                    <td><?= str_pad($no++, 2, '0', STR_PAD_LEFT) ?></td>
                    <td><?= esc($dept['department_name']) ?></td>
                    <td>
                        <div class="row-actions">
                            <a href="/departments/edit/<?= $dept['id'] ?>" class="btn-edit">Edit</a>
                            <form action="/departments/<?= $dept['id'] ?>" method="post" style="display:inline;" onsubmit="return confirm('Hapus departemen ini?')">
                                <input type="hidden" name="_method" value="DELETE">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($departments)): ?>
        <div class="table-footer">
            <?= count($departments) ?> departemen terdaftar
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>