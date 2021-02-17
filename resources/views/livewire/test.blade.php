<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<style>
  .container {
      display: flex;
  }  
    </style>

<div>
{{ date("H:i:s") }}
    <div class="container" x-data="{ open: false }">
        <button @click="open = true">Open Dropdown</button>
    
        <ul
            x-show="open"
            @click.away="open = false"
        >
            Dropdown Bodyt
        </ul>
    </div>

    <div x-data="{ tab: 'foo' }">
        <button :class="{ 'active': tab === 'foo' }" @click="tab = 'foo'">Foo</button>
        <button :class="{ 'active': tab === 'bar' }" @click="tab = 'bar'">Bar</button>
    
        <div x-show="tab === 'foo'">Tab Foo</div>
        <div x-show="tab === 'bar'">Tab Bar</div>
    </div>

</div>

<div>
<span x-ref="foo">hello</span>

<button @click="$refs.foo.innerHTML = 'bar'">Click me</button>
</div>

<div x-data>
    <button @click="$el.innerHTML = 'foo'">Replace me with "foo"</button>
</div>

<div  x-data="{ div_status: true }">
    <div x-show="div_status">My Div</div>

    <a @click="div_status = false">Hide Div</a>

</div>
