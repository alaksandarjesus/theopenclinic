@if(!empty($icon))

@if($icon == 'close')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-slate-900'}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
</svg>
@endif


@if($icon === 'person-outline')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-white'}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
</svg>
@endif

@if($icon === 'edit')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-orange-400'}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z" />
</svg>
@endif

@if($icon === 'delete')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-red-800'}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z" />
</svg>
@endif

@if($icon === 'sync')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-green-700'}}">
    <path d="M.01 0h24v24h-24V0z" fill="none" />
    <path
        d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46C19.54 15.03 20 13.57 20 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74C4.46 8.97 4 10.43 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z" />
</svg>
@endif

@if($icon === 'return')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-rose-700'}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path d="M19 7v4H5.83l3.58-3.59L8 6l-6 6 6 6 1.41-1.41L5.83 13H21V7h-2z" />
</svg>
@endif

@if($icon === 'inventory')
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-blue-700'}}">
    <g>
        <rect fill="none" height="24" width="24" />
    </g>
    <g>
        <g>
            <path
                d="M5,5h2v3h10V5h2v5h2V5c0-1.1-0.9-2-2-2h-4.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H5C3.9,3,3,3.9,3,5v14 c0,1.1,0.9,2,2,2h6v-2H5V5z M12,3c0.55,0,1,0.45,1,1s-0.45,1-1,1s-1-0.45-1-1S11.45,3,12,3z" />
            <polygon points="21,11.5 15.51,17 12.5,14 11,15.5 15.51,20 22.5,13" />
        </g>
    </g>
</svg>
@endif

@if($icon === 'print')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:'fill-sky-700'}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M19 8h-1V3H6v5H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zM8 5h8v3H8V5zm8 12v2H8v-4h8v2zm2-2v-2H6v2H4v-4c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v4h-2z" />
    <circle cx="18" cy="11.5" r="1" />
</svg>

@endif
@if($icon === 'question-outline')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z" />
</svg>
@endif

@if($icon === 'fact-check')
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <g>
        <rect fill="none" height="24" width="24" />
    </g>
    <g>
        <g>
            <path
                d="M20,3H4C2.9,3,2,3.9,2,5v14c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V5 C22,3.9,21.1,3,20,3z M20,19H4V5h16V19z"
                fill-rule="evenodd" />
            <polygon fill-rule="evenodd" points="19.41,10.42 17.99,9 14.82,12.17 13.41,10.75 12,12.16 14.82,15" />
            <rect fill-rule="evenodd" height="2" width="5" x="5" y="7" />
            <rect fill-rule="evenodd" height="2" width="5" x="5" y="11" />
            <rect fill-rule="evenodd" height="2" width="5" x="5" y="15" />
        </g>
    </g>
</svg>
@endif

@if($icon === 'account-box')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M19 5v14H5V5h14m0-2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 9c-1.65 0-3-1.35-3-3s1.35-3 3-3 3 1.35 3 3-1.35 3-3 3zm0-4c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm6 10H6v-1.53c0-2.5 3.97-3.58 6-3.58s6 1.08 6 3.58V18zm-9.69-2h7.38c-.69-.56-2.38-1.12-3.69-1.12s-3.01.56-3.69 1.12z" />
</svg>

@endif

@if($icon ==='payments')
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <g>
        <rect fill="none" height="24" width="24" />
        <path
            d="M19,14V6c0-1.1-0.9-2-2-2H3C1.9,4,1,4.9,1,6v8c0,1.1,0.9,2,2,2h14C18.1,16,19,15.1,19,14z M17,14H3V6h14V14z M10,7 c-1.66,0-3,1.34-3,3s1.34,3,3,3s3-1.34,3-3S11.66,7,10,7z M23,7v11c0,1.1-0.9,2-2,2H4c0-1,0-0.9,0-2h17V7C22.1,7,22,7,23,7z" />

    </g>
</svg>
@endif

@if($icon === 'manage-history')
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <g>
        <rect fill="none" height="24" width="24" />
    </g>
    <g>
        <path
            d="M22.69,18.37l1.14-1l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L20,14h-2l-0.3,1.49c-0.4,0.15-0.76,0.36-1.08,0.63 l-1.45-0.49l-1,1.73l1.14,1c-0.08,0.5-0.08,0.76,0,1.26l-1.14,1l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L18,24h2l0.3-1.49 c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1C22.77,19.13,22.77,18.87,22.69,18.37z M19,21c-1.1,0-2-0.9-2-2s0.9-2,2-2 s2,0.9,2,2S20.1,21,19,21z M11,7v5.41l2.36,2.36l1.04-1.79L13,11.59V7H11z M21,12c0-4.97-4.03-9-9-9C9.17,3,6.65,4.32,5,6.36V4H3v6 h6V8H6.26C7.53,6.19,9.63,5,12,5c3.86,0,7,3.14,7,7H21z M10.86,18.91C7.87,18.42,5.51,16.01,5.08,13H3.06c0.5,4.5,4.31,8,8.94,8 c0.02,0,0.05,0,0.07,0L10.86,18.91z" />
    </g>
</svg>
@endif
@if($icon === 'arrow-forward')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8-8-8z" />
</svg>
@endif

@if($icon === 'arrow-back')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
</svg>
@endif

@if($icon === 'today')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0z" fill="none" />
    <path
        d="M20 3h-1V2c0-.55-.45-1-1-1s-1 .45-1 1v1H7V2c0-.55-.45-1-1-1s-1 .45-1 1v1H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 18H5c-.55 0-1-.45-1-1V8h16v12c0 .55-.45 1-1 1z" />
</svg>
</svg>
@endif

@if ($icon === 'dropdown')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M12 4c4.41 0 8 3.59 8 8s-3.59 8-8 8-8-3.59-8-8 3.59-8 8-8m0-2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 13l-4-4h8z" />
</svg>
@endif

@if ($icon === 'invoice')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M19.5 3.5L18 2l-1.5 1.5L15 2l-1.5 1.5L12 2l-1.5 1.5L9 2 7.5 3.5 6 2 4.5 3.5 3 2v20l1.5-1.5L6 22l1.5-1.5L9 22l1.5-1.5L12 22l1.5-1.5L15 22l1.5-1.5L18 22l1.5-1.5L21 22V2l-1.5 1.5zM19 19.09H5V4.91h14v14.18zM6 15h12v2H6zm0-4h12v2H6zm0-4h12v2H6z" />
</svg>
@endif
@if ($icon === 'appointment')
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <g>
        <rect fill="none" height="24" width="24" />
    </g>
    <g>
        <g>
            <circle cx="12" cy="6" r="2" />
            <circle cx="6" cy="18" r="2" />
            <circle cx="6" cy="12" r="2" />
            <circle cx="6" cy="6" r="2" />
            <circle cx="18" cy="6" r="2" />
            <path
                d="M11,18.07v1.43c0,0.28,0.22,0.5,0.5,0.5h1.4c0.13,0,0.26-0.05,0.35-0.15l5.83-5.83l-2.12-2.12l-5.81,5.81 C11.05,17.81,11,17.94,11,18.07z" />
            <path d="M12.03,14L14,12.03V12c0-1.1-0.9-2-2-2s-2,0.9-2,2s0.9,2,2,2H12.03z" />
            <path
                d="M20.85,11.56l-1.41-1.41c-0.2-0.2-0.51-0.2-0.71,0l-1.06,1.06l2.12,2.12l1.06-1.06C21.05,12.07,21.05,11.76,20.85,11.56z" />
        </g>
    </g>
</svg>
@endif

@if ($icon === 'invoice-return')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path class="mt-8 absolute"
        d="M19 8v3H5.83l2.88-2.88c.39-.39.39-1.02 0-1.41-.39-.39-1.02-.39-1.41 0L2.71 11.3c-.39.39-.39 1.02 0 1.41L7.3 17.3c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L5.83 13H20c.55 0 1-.45 1-1V8c0-.55-.45-1-1-1s-1 .45-1 1z" />
</svg>
@endif
@if ($icon === 'purchase-return')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path
        d="M19 8v3H5.83l2.88-2.88c.39-.39.39-1.02 0-1.41-.39-.39-1.02-.39-1.41 0L2.71 11.3c-.39.39-.39 1.02 0 1.41L7.3 17.3c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L5.83 13H20c.55 0 1-.45 1-1V8c0-.55-.45-1-1-1s-1 .45-1 1z" />
</svg>
@endif
@if ($icon === 'purchase')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <path d="M0 0h24v24H0V0z" fill="none" />
    <path
        d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 3c0 .55.45 1 1 1h1l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h11c.55 0 1-.45 1-1s-.45-1-1-1H7l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.67-1.43c-.16-.35-.52-.57-.9-.57H2c-.55 0-1 .45-1 1zm16 15c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
</svg>
@endif

@if ($icon === 'expenditure')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <g>
        <rect fill="none" height="24" width="24" />
        <path
            d="M18,3h-3.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H6C4.9,3,4,3.9,4,5v15c0,1.1,0.9,2,2,2h6.11 c-0.59-0.57-1.07-1.25-1.42-2H6V5h2v1c0,1.1,0.9,2,2,2h4c1.1,0,2-0.9,2-2V5h2v5.08c0.71,0.1,1.38,0.31,2,0.6V5C20,3.9,19.1,3,18,3z M12,5c-0.55,0-1-0.45-1-1c0-0.55,0.45-1,1-1c0.55,0,1,0.45,1,1C13,4.55,12.55,5,12,5z M17,12c-2.76,0-5,2.24-5,5s2.24,5,5,5 c2.76,0,5-2.24,5-5S19.76,12,17,12z M18.29,19l-1.65-1.65c-0.09-0.09-0.15-0.22-0.15-0.35l0-2.49c0-0.28,0.22-0.5,0.5-0.5h0 c0.28,0,0.5,0.22,0.5,0.5l0,2.29l1.5,1.5c0.2,0.2,0.2,0.51,0,0.71v0C18.8,19.2,18.49,19.2,18.29,19z" />
    </g>
</svg>
@endif

@if ($icon === 'consultation')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
    class="{{!empty($className)?$className:''}}">
    <g>
        <rect fill="none" height="24" width="24" />
        <rect fill="none" height="24" width="24" />
    </g>
    <g>
        <g>
            <path
                d="M21,12.22C21,6.73,16.74,3,12,3c-4.69,0-9,3.65-9,9.28C2.4,12.62,2,13.26,2,14v2c0,1.1,0.9,2,2,2h0c0.55,0,1-0.45,1-1 l0-4.81c0-3.83,2.95-7.18,6.78-7.29c3.96-0.12,7.22,3.06,7.22,7V19h-7c-0.55,0-1,0.45-1,1v0c0,0.55,0.45,1,1,1h7c1.1,0,2-0.9,2-2 v-1.22c0.59-0.31,1-0.92,1-1.64v-2.3C22,13.14,21.59,12.53,21,12.22z" />
            <circle cx="9" cy="13" r="1" />
            <circle cx="15" cy="13" r="1" />
            <path
                d="M18,11.03C17.52,8.18,15.04,6,12.05,6c-3.03,0-6.29,2.51-6.03,6.45c2.47-1.01,4.33-3.21,4.86-5.89 C12.19,9.19,14.88,11,18,11.03z" />
        </g>
    </g>
</svg>
@endif

@if ($icon === 'menu')
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" class="{{!empty($className)?$className:''}}"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
@endif
@endif