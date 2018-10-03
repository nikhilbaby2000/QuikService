<div class="flash flash-full flash-{{$type}}">
    <div class="container">
        <button class="flash-close js-flash-close" type="button">
            <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
        </button>
        {!! $message !!}
    </div>
</div>
<style>
    .flash {
        padding: 15px 20px;
        margin: 0 auto;
        margin-bottom: 10px;
        font-size: 13px;
        border-style: solid;
        border-width: 1px;
        border-radius: 5px;
    }
    .flash-full {
        margin-top: -1px;
        border-width: 1px 0;
        border-radius: 0;
    }

    .flash {
        position: relative;
        padding: 16px;
        color: #032f62;
        background-color: #dbedff;
        border: 1px solid rgba(27,31,35,0.15);
        border-radius: 3px;
    }
    .flash-error {
        color: #86181d;
        background-color: #ffdce0;
        border-color: rgba(27,31,35,0.15);
    }
    .flash-close {
        float: right;
        padding: 16px;
        margin: -16px;
        color: inherit;
        text-align: center;
        cursor: pointer;
        background: none;
        border: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        opacity: 0.6;
    }
    .flash-warn {
        color: #735c0f;
        background-color: #fffbdd;
        border-color: rgba(27,31,35,0.15);
    }
    .container {
        width: 980px;
        margin-right: auto;
        margin-left: auto;
    }
    .flash-full .container {
        width: 100%;
        max-width: 980px;
    }
    h4 {
        font-size: 16px;
        font-weight: 600;
    }
    h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 0;
    }
</style>