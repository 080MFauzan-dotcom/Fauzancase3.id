<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar.id</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #23243a;
            --muted: #626477;
            --line: #ececf3;
            --paper: #ffffff;
            --canvas: #f7f7fb;
            --violet: #6858e8;
            --violet-dark: #4c3fd2;
            --sidebar: #202039;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
        }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--canvas); }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        .app-shell { min-height: 100vh; display: grid; grid-template-columns: 248px minmax(0, 1fr); }
        .sidebar { height: 100vh; position: sticky; top: 0; display: flex; flex-direction: column; padding: 25px 16px 18px; color: #fff; background: var(--sidebar); }
        .brand { display: flex; align-items: center; gap: 12px; padding: 0 10px 31px; font-size: 19px; font-weight: 800; letter-spacing: -.5px; }
        .brand-mark { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 13px; color: #fff; background: linear-gradient(145deg, #a899ff, #6454e5); box-shadow: 0 7px 18px #7666f54d; }
        .brand small { display: block; margin-top: 2px; color: #c1c1d2; font-size: 11px; font-weight: 600; letter-spacing: .8px; text-transform: uppercase; }
        .nav-label { padding: 0 12px 10px; color: #aaaac1; font-size: 11px; font-weight: 750; letter-spacing: 1.3px; }
        .side-nav { display: grid; gap: 6px; }
        .nav-link { display: flex; align-items: center; gap: 12px; min-height: 43px; padding: 0 12px; border-radius: 10px; color: #d0d0e0; font-size: 14px; font-weight: 650; transition: background .18s, color .18s; }
        .nav-link:hover, .nav-link.active { color: white; background: #ffffff14; }
        .nav-link.active { box-shadow: inset 3px 0 #9c8fff; }
        .nav-icon { width: 20px; color: #c1bfd6; text-align: center; font-size: 16px; }
        .sidebar-bottom { margin-top: auto; }
        .streak-card { margin: 0 3px 18px; padding: 14px 13px 12px; border: 1px solid #ffffff19; border-radius: 14px; background: linear-gradient(145deg, #ffffff12, #ffffff07); }
        .streak-head { display: flex; align-items: center; gap: 8px; }
        .streak-flame { font-size: 17px; }
        .streak-title { color: white; font-size: 12px; font-weight: 750; }
        .streak-count { margin-left: auto; color: #ffd28b; font-size: 12px; font-weight: 800; }
        .streak-note { margin: 5px 0 11px 25px; color: #bdbdd0; font-size: 12px; }
        .streak-days { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; }
        .streak-day { display: grid; justify-items: center; gap: 5px; color: #c6c6d6; font-size: 11px; font-weight: 700; }
        .streak-dot { width: 17px; height: 17px; display: grid; place-items: center; border: 1px solid #ffffff35; border-radius: 50%; color: transparent; background: #ffffff0b; font-size: 9px; }
        .streak-day.active .streak-dot { border-color: #ffb84e; color: #4a2d0b; background: #ffb84e; }
        .profile { display: flex; align-items: center; gap: 10px; padding: 13px 8px 0; border-top: 1px solid #ffffff17; }
        .profile-link { min-width: 0; flex: 1; display: flex; align-items: center; gap: 10px; padding: 5px; border-radius: 10px; transition: background .16s; }
        .profile-link:hover, .profile-link.active { background: #ffffff12; }
        .profile-link:focus-visible { outline: 2px solid #aa9fff; outline-offset: 2px; }
        .avatar { width: 35px; height: 35px; flex: 0 0 auto; display: grid; place-items: center; border-radius: 12px; color: #ece9ff; background: #6b5ce7; font-size: 13px; font-weight: 750; }
        .profile-name { min-width: 0; display: block; overflow: hidden; color: white; font-size: 13px; font-weight: 700; text-overflow: ellipsis; white-space: nowrap; }
        .profile-role { display: block; margin-top: 3px; color: #c9c9d8; font-size: 11px; }
        .logout-form { margin-left: auto; }
        .logout-button { padding: 7px; border: 0; border-radius: 8px; color: #c7c6d8; background: transparent; cursor: pointer; }
        .logout-button:hover { color: white; background: #ffffff14; }
        .workspace { min-width: 0; padding: 27px clamp(20px, 4vw, 58px) 50px; }
        .workspace-inner { max-width: 1390px; margin: 0 auto; }
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 31px; }
        .topbar-user { display: grid; gap: 3px; min-width: 0; }
        .topbar-greeting { color: var(--muted); font-size: 13px; font-weight: 650; }
        .topbar-user strong { overflow: hidden; color: var(--ink); font-size: 15px; font-weight: 800; text-overflow: ellipsis; white-space: nowrap; }
        .topbar-right { display: flex; align-items: center; gap: 9px; }
        .topbar-actions { display: flex; align-items: center; gap: 8px; }
        .theme-toggle { width: 38px; height: 38px; display: grid; place-items: center; border: 1px solid var(--line); border-radius: 11px; color: var(--ink); background: var(--paper); font-size: 16px; cursor: pointer; transition: background .16s, border-color .16s, transform .16s; }
        .theme-toggle:hover { transform: translateY(-1px); border-color: #bcb5f2; }
        .topbar-add { min-height: 38px; display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 0 12px; border: 1px solid #5548d2; border-radius: 11px; color: white; background: #6254dc; font-size: 13px; font-weight: 750; transition: background .16s, transform .16s; }
        .topbar-add:hover { transform: translateY(-1px); background: #4c3fd2; }
        .top-icon { width: 38px; height: 38px; display: grid; place-items: center; border: 1px solid var(--line); border-radius: 12px; color: #5f6074; background: white; }
        .top-avatar { width: 38px; height: 38px; display: grid; place-items: center; border: 3px solid white; border-radius: 13px; color: white; background: #e8a879; font-size: 12px; font-weight: 800; box-shadow: 0 2px 9px #20203918; }
        .page-content { min-width: 0; }
        .page-heading { display: flex; align-items: end; justify-content: space-between; gap: 16px; margin-bottom: 23px; }
        .eyebrow { color: var(--violet); font-size: 10px; font-weight: 800; letter-spacing: 1.3px; text-transform: uppercase; }
        .page-heading h1 { margin: 8px 0 5px; font-size: clamp(25px, 3vw, 33px); letter-spacing: -1.2px; }
        .page-heading p { margin: 0; color: var(--muted); font-size: 14px; font-weight: 500; }
        .date-chip { padding: 10px 13px; border: 1px solid var(--line); border-radius: 10px; color: #4f5065; background: white; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .hero { position: relative; display: flex; min-height: 176px; overflow: hidden; align-items: center; justify-content: space-between; gap: 25px; padding: 28px 34px; border-radius: 19px; color: white; background: linear-gradient(112deg, #5549d5 0%, #7462ed 64%, #8b78f4 100%); box-shadow: 0 15px 34px #6256dc26; }
        .hero-copy { position: relative; z-index: 1; max-width: 550px; }
        .hero-kicker { color: #f0edff; font-size: 11px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; }
        .hero h2 { margin: 10px 0 8px; font-size: clamp(22px, 3vw, 30px); letter-spacing: -.8px; }
        .hero p { margin: 0; color: #f4f2ff; font-size: 13px; font-weight: 500; line-height: 1.6; }
        .hero-mark { position: absolute; right: 88px; top: -65px; width: 270px; height: 270px; border: 1px solid #ffffff28; border-radius: 50%; }
        .hero-mark:before, .hero-mark:after { position: absolute; content: ""; border: 1px solid #ffffff20; border-radius: 50%; }
        .hero-mark:before { inset: 25px; }
        .hero-mark:after { inset: 52px; }
        .hero-sticker { position: relative; z-index: 1; width: 123px; height: 123px; flex: 0 0 auto; display: grid; place-items: center; border: 1px solid #ffffff40; border-radius: 27px; background: #ffffff18; transform: rotate(6deg); }
        .hero-sticker span { font-size: 48px; transform: rotate(-6deg); }
        .stats-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 13px; margin: 18px 0 23px; }
        .stat-card { min-width: 0; padding: 17px 18px 15px; border: 1px solid var(--line); border-radius: 14px; background: var(--paper); box-shadow: 0 5px 16px #22204405; }
        .stat-top { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
        .stat-label { color: var(--muted); font-size: 12px; font-weight: 700; }
        .stat-icon { width: 30px; height: 30px; display: grid; place-items: center; border-radius: 10px; font-size: 14px; }
        .stat-violet { color: #6254dc; background: #f0eeff; }
        .stat-blue { color: #3c83c7; background: #eaf5ff; }
        .stat-green { color: #369675; background: #e8f7f1; }
        .stat-orange { color: #cf8745; background: #fff3e8; }
        .stat-number { margin-top: 11px; font-size: 27px; font-weight: 800; letter-spacing: -1px; }
        .stat-foot { margin-top: 3px; color: #68697c; font-size: 11px; font-weight: 600; }
        .progress-track { height: 4px; overflow: hidden; margin-top: 11px; border-radius: 10px; background: #efeff5; }
        .progress-fill { height: 100%; border-radius: inherit; background: #57b892; }
        .dashboard-grid { display: grid; grid-template-columns: minmax(0, 1.6fr) minmax(270px, .85fr); align-items: start; gap: 17px; }
        .panel { min-width: 0; border: 1px solid var(--line); border-radius: 16px; background: white; box-shadow: 0 5px 18px #22204405; }
        .panel-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 19px 21px 14px; }
        .panel-title { margin: 0; font-size: 15px; font-weight: 750; letter-spacing: -.2px; }
        .panel-subtitle { margin: 4px 0 0; color: var(--muted); font-size: 11px; }
        .count-chip { padding: 6px 9px; border-radius: 8px; color: #6356dd; background: #f0eeff; font-size: 10px; font-weight: 750; white-space: nowrap; }
        .filter-bar { display: grid; grid-template-columns: minmax(135px, 1fr) 145px 140px auto; gap: 8px; padding: 0 20px 15px; }
        .field-control { width: 100%; min-width: 0; height: 37px; padding: 0 10px; border: 1px solid #e8e8ef; border-radius: 9px; outline: none; color: #46475c; background: #fcfcfe; font-size: 11px; }
        .field-control:focus, .form-control:focus { border-color: #9c91f1; box-shadow: 0 0 0 3px #7564e815; }
        .filter-button { height: 37px; padding: 0 12px; border: 0; border-radius: 9px; color: white; background: var(--violet); font-size: 11px; font-weight: 700; cursor: pointer; }
        .filter-button:hover, .submit-button:hover { background: var(--violet-dark); }
        .task-list { padding: 0 13px 7px; }
        .task-row { display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(95px, .75fr) minmax(105px, .8fr) minmax(142px, auto); align-items: center; gap: 11px; padding: 13px 8px; border-top: 1px solid #f0f0f5; }
        .task-name { overflow: hidden; font-size: 12px; font-weight: 700; text-overflow: ellipsis; white-space: nowrap; }
        .task-meta { overflow: hidden; margin-top: 5px; color: #6b6c7f; font-size: 11px; font-weight: 550; text-overflow: ellipsis; white-space: nowrap; }
        .course-name { color: #55566a; font-size: 12px; font-weight: 650; }
        .task-status, .priority-pill { display: inline-flex; align-items: center; gap: 5px; width: fit-content; padding: 5px 8px; border-radius: 7px; font-size: 9px; font-weight: 700; white-space: nowrap; }
        .status-pending { color: #ae7a27; background: #fff6e8; }
        .status-in_progress { color: #4d73c7; background: #edf3ff; }
        .status-completed { color: #328567; background: #eaf8f1; }
        .priority-high { color: #c4605b; background: #fff0ef; }
        .priority-medium { color: #bd8a38; background: #fff7e8; }
        .priority-low { color: #77788b; background: #f2f2f6; }
        .task-tags { display: flex; flex-wrap: wrap; align-items: center; gap: 5px; }
        .deadline { color: #626377; font-size: 11px; font-weight: 550; }
        .row-actions { display: flex; align-items: center; justify-content: flex-end; gap: 5px; }
        .mini-action { padding: 6px 7px; border: 0; border-radius: 7px; color: #686982; background: #f4f3fc; font-size: 10px; font-weight: 650; cursor: pointer; }
        .mini-action:hover { color: var(--violet-dark); background: #eeecff; }
        .mini-danger { color: #c05d5d; background: #fff0ef; }
        .task-empty { padding: 36px 12px; color: var(--muted); text-align: center; font-size: 13px; font-weight: 500; }
        .pagination-wrap { padding: 10px 19px 16px; color: #626377; font-size: 12px; }
        .pagination-nav { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 12px 20px 16px; border-top: 1px solid #f0f0f5; color: #85869a; font-size: 10px; }
        .pagination-nav a { color: #6254dc; font-weight: 700; }
        .pagination-nav a:hover { color: var(--violet-dark); }
        .page-disabled { color: #c0c0cb; }
        .quick-panel { padding: 19px; }
        .quick-heading { display: flex; align-items: flex-start; justify-content: space-between; gap: 8px; margin-bottom: 15px; }
        .quick-mark { width: 31px; height: 31px; display: grid; place-items: center; border-radius: 10px; color: var(--violet); background: #f0eeff; font-size: 18px; }
        .form-field { margin-bottom: 11px; }
        .form-label { display: block; margin-bottom: 5px; color: #4e4f63; font-size: 11px; font-weight: 750; }
        .form-control { width: 100%; min-height: 38px; padding: 9px 10px; border: 1px solid #e8e8ef; border-radius: 9px; outline: none; color: #44455a; background: #fcfcfe; font-size: 11px; }
        textarea.form-control { min-height: 62px; resize: vertical; }
        .form-two { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; }
        .submit-button { width: 100%; min-height: 41px; margin-top: 3px; border: 0; border-radius: 10px; color: white; background: var(--violet); font-size: 11px; font-weight: 750; cursor: pointer; transition: background .18s; }
        .form-note { margin: 10px 0 0; color: #9a9aaa; font-size: 9px; line-height: 1.5; text-align: center; }
        .flash { margin-bottom: 15px; padding: 11px 14px; border-radius: 10px; font-size: 12px; }
        .flash-success { color: #287c5b; background: #e9f8f0; }
        .flash-error { color: #aa4b4b; background: #fff0ef; }
        .flash ul { margin: 6px 0 0; padding-left: 18px; }
        body[data-theme="dark"] {
            color-scheme: dark;
            --ink: #eeedf8;
            --muted: #aaa9be;
            --line: #37374d;
            --paper: #242438;
            --canvas: #171725;
            --sidebar: #11111f;
        }
        body[data-theme="dark"] .workspace { color: var(--ink); }
        body[data-theme="dark"] .top-icon,
        body[data-theme="dark"] .theme-toggle,
        body[data-theme="dark"] .date-chip,
        body[data-theme="dark"] .panel,
        body[data-theme="dark"] .stat-card,
        body[data-theme="dark"] .profile-panel,
        body[data-theme="dark"] .filter-panel,
        body[data-theme="dark"] .question-card,
        body[data-theme="dark"] .quiz-intro,
        body[data-theme="dark"] .submit-quiz {
            border-color: var(--line);
            color: var(--ink);
            background: var(--paper);
        }
        body[data-theme="dark"] .page-heading h1,
        body[data-theme="dark"] .panel-title,
        body[data-theme="dark"] .stat-number,
        body[data-theme="dark"] .task-name,
        body[data-theme="dark"] .upcoming-title,
        body[data-theme="dark"] .profile-panel-head h3,
        body[data-theme="dark"] .profile-fact span:last-child,
        body[data-theme="dark"] .question-prompt,
        body[data-theme="dark"] .subject-card h3 {
            color: var(--ink);
        }
        body[data-theme="dark"] .field-control,
        body[data-theme="dark"] .form-control,
        body[data-theme="dark"] .filter-input,
        body[data-theme="dark"] .profile-input,
        body[data-theme="dark"] .task-table th,
        body[data-theme="dark"] .task-table td,
        body[data-theme="dark"] .choice-option,
        body[data-theme="dark"] .subject-card {
            border-color: var(--line);
            color: var(--ink);
            background: #1d1d30;
        }
        body[data-theme="dark"] .task-row,
        body[data-theme="dark"] .upcoming-row,
        body[data-theme="dark"] .profile-panel-head,
        body[data-theme="dark"] .profile-fact {
            border-color: var(--line);
        }
        body[data-theme="dark"] .quick-link { border-color: var(--line); }
        body[data-theme="dark"] .quick-link:hover { background: #2b2a43; }
        body[data-theme="dark"] .quick-link-text,
        body[data-theme="dark"] .task-table .task-name { color: var(--ink); }
        body[data-theme="dark"] .task-table tbody tr:hover { background: #2b2a43; }
        body[data-theme="dark"] .choice-option:hover { background: #2b2a43; }
        body[data-theme="dark"] .progress-track { background: #38384e; }
        body[data-theme="dark"] .progress-track::-webkit-progress-bar { background: #38384e; }
        @media (max-width: 1100px) {
            .app-shell { grid-template-columns: 215px minmax(0, 1fr); }
            .workspace { padding-right: 25px; padding-left: 25px; }
            .dashboard-grid { grid-template-columns: minmax(0, 1.35fr) minmax(250px, .9fr); }
            .filter-bar { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 850px) {
            .app-shell { display: block; }
            .sidebar { width: 100%; height: auto; position: relative; padding: 13px 18px; }
            .brand { padding: 0 4px 12px; }
            .nav-label, .sidebar-bottom { display: none; }
            .side-nav { display: flex; overflow-x: auto; }
            .nav-link { min-height: 37px; padding: 0 11px; white-space: nowrap; }
            .workspace { padding-top: 19px; }
        }
        @media (max-width: 650px) {
            .workspace { padding: 17px 14px 35px; }
            .topbar { margin-bottom: 22px; }
            .topbar-actions { gap: 6px; }
            .topbar-add { width: 38px; padding: 0; font-size: 0; }
            .topbar-add .topbar-add-icon { font-size: 19px; }
            .topbar-add .topbar-add-label { display: none; }
            .hero { min-height: 155px; padding: 22px; }
            .hero-sticker { width: 80px; height: 80px; border-radius: 21px; }
            .hero-sticker span { font-size: 34px; }
            .hero-mark { right: 10px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 9px; }
            .stat-card { padding: 14px; }
            .dashboard-grid { grid-template-columns: 1fr; }
            .task-row { grid-template-columns: minmax(0, 1fr) auto; gap: 8px; }
            .task-row > :nth-child(2) { display: none; }
            .task-row > :nth-child(3) { grid-column: 1; }
            .task-row > :nth-child(4) { grid-column: 2; grid-row: 2; }
            .page-heading { align-items: flex-start; }
        }
        @media (max-width: 410px) {
            .filter-bar { grid-template-columns: 1fr; }
            .page-heading h1 { font-size: 24px; }
            .hero-sticker { display: none; }
            .hero-mark { right: -100px; }
        }
    </style>
    @stack('styles')
    <style>
        .app-shell .page-content .page-heading p,
        .app-shell .page-content :is(
            .panel-subtitle, .stat-foot, .upcoming-course, .upcoming-date,
            .quick-link-sub, .subject-count, .subject-card p, .quiz-note,
            .quiz-intro p, .question-label, .submit-quiz p, .review-answer,
            .review-explanation, .profile-hero-copy p, .profile-panel-head p,
            .profile-help, .security-note, .profile-fact span:first-child,
            .task-description, .filter-field label, .table-empty,
            .pagination-nav, .trash-meta, .form-note, .tip-panel p,
            .tip-item, .form-panel-head p, .question-number, .status-text
        ) {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }
        .app-shell .page-content .task-table th {
            color: var(--muted);
            font-size: 12px;
            font-weight: 750;
        }
        .app-shell .page-content :is(
            .task-table td, .filter-input, .choice-option, .profile-input,
            .form-control, .field-control
        ) {
            color: var(--ink);
            font-size: 14px;
            font-weight: 500;
        }
        .app-shell .page-content :is(
            .filter-submit, .clear-filter, .add-task-link, .action-link,
            .action-button, .type-tag, .status-tag, .priority-tag,
            .profile-submit, .profile-alert, .profile-badge,
            .question-number, .subject-start, .trash-button,
            .submit-button, .filter-button, .mini-action
        ) {
            font-size: 13px;
            font-weight: 700;
        }
        .app-shell .page-content .profile-label,
        .app-shell .page-content .question-label,
        .app-shell .page-content .filter-field label {
            font-size: 12px;
        }
        .app-shell .page-content .profile-fact {
            font-size: 13px;
            font-weight: 600;
        }
        .app-shell .page-content :is(.task-name, .trash-name, .upcoming-title, .subject-card h3) { font-size: 14px; }
        .app-shell .page-content :is(.panel-title, .profile-panel-head h3, .review-heading) { font-size: 17px; }
        .app-shell .page-content .eyebrow { font-size: 11px; }
        .app-shell .page-content :is(p, li, label, th, td, input, select, textarea, button, a) {
            font-size: 14px;
        }
        .app-shell .page-content :is(
            [class*="label"], [class*="subtitle"], [class*="meta"],
            [class*="note"], [class*="help"], [class*="foot"],
            [class*="description"], [class*="caption"], [class*="empty"],
            [class*="quick-link-text"], .task-meta, .deadline,
            .course-name, .status-text
        ) {
            font-size: 13px;
        }
        .app-shell .page-content :is(
            [class*="badge"], [class*="tag"], [class*="status"],
            [class*="priority"], [class*="chip"], .action-link,
            .action-button, .mini-action
        ) {
            font-size: 12px;
        }
        .app-shell .page-content :is(
            .panel-title, .profile-panel-head h3, .review-heading
        ) {
            font-size: 17px;
        }
        .app-shell .page-content :is(
            .task-name, .trash-name, .upcoming-title, .subject-card h3,
            .question-prompt, .review-question
        ) {
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}">
            <span class="brand-mark">ID</span>
            <span>Belajar.id<small>Tempat Bertumbuh by.ozan</small></span>
        </a>
        <div class="nav-label">MENU UTAMA</div>
        <nav class="side-nav">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span class="nav-icon">⌂</span>Dashboard</a>
            <a class="nav-link {{ request()->routeIs('tasks.index', 'tasks.edit') ? 'active' : '' }}" href="{{ route('tasks.index') }}"><span class="nav-icon">▤</span>Daftar tugas</a>
            <a class="nav-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}" href="{{ route('tasks.create') }}"><span class="nav-icon">＋</span>Tambah tugas</a>
            <a class="nav-link {{ request()->routeIs('quizzes.*') ? 'active' : '' }}" href="{{ route('quizzes.index') }}"><span class="nav-icon">></span>Latihan soal</a>
            <a class="nav-link {{ request()->routeIs('tasks.trash') ? 'active' : '' }}" href="{{ route('tasks.trash') }}"><span class="nav-icon">♧</span>Sampah</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="streak-card">
                <div class="streak-head">
                    <span class="streak-flame" aria-hidden="true">🔥</span>
                    <span class="streak-title">Study streak</span>
                    <span class="streak-count">{{ $studyStreak ?? 0 }} hari</span>
                </div>
                <p class="streak-note">Hari berturut-turut mencatat tugas</p>
                <div class="streak-days" aria-label="Aktivitas minggu ini">
                    @foreach (($weeklyActivity ?? collect()) as $day)
                        <span class="streak-day {{ $day['count'] > 0 ? 'active' : '' }}" title="{{ $day['count'] }} tugas dicatat">
                            {{ $day['label'] }}
                            <span class="streak-dot" aria-hidden="true">{{ $day['count'] > 0 ? '✓' : '' }}</span>
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="profile">
                <a class="profile-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}" aria-label="Buka profil {{ auth()->user()->name }}">
                    <span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span style="min-width: 0">
                        <span class="profile-name">{{ auth()->user()->name }}</span>
                        <span class="profile-role">Mahasiswa</span>
                    </span>
                </a>
                <form class="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-button" type="submit" title="Keluar" aria-label="Keluar">↪</button>
                </form>
            </div>
        </div>
    </aside>

    <main class="workspace">
        <div class="workspace-inner">
            <header class="topbar">
                <div class="topbar-user">
                    <span class="topbar-greeting">Selamat datang all dari dev-oz</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <div class="topbar-right">
                    <div class="topbar-actions">
                        <button class="theme-toggle" type="button" aria-label="Aktifkan mode gelap" title="Ganti tema">
                            <span aria-hidden="true">☾</span>
                        </button>
                        <a class="topbar-add" href="{{ route('tasks.create') }}"><span class="topbar-add-icon" aria-hidden="true">＋</span><span class="topbar-add-label">Tugas Baru</span></a>
                    </div>
                </div>
            </header>
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </main>
</div>
<script>
    (function () {
        var themeButton = document.querySelector('.theme-toggle');
        var savedTheme = localStorage.getItem('belajar-id-theme') || 'light';

        function applyTheme(theme) {
            document.body.dataset.theme = theme;
            themeButton.querySelector('span').textContent = theme === 'dark' ? '☀' : '☾';
            themeButton.setAttribute('aria-label', theme === 'dark' ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
        }

        applyTheme(savedTheme);
        themeButton.addEventListener('click', function () {
            var nextTheme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
            localStorage.setItem('belajar-id-theme', nextTheme);
            applyTheme(nextTheme);
        });
    }());
</script>
</body>
</html>
