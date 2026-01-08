<div id="alert" {{ $attributes }}>
    {{ $slot }}
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
</div>
<style>
    #alert{
        width: 100%;
        padding: 5px;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #f2f2f2;
    }
    #alert.danger{
        background-color: #fff2f2;
        color:red;
    }
    #alert.info{
        background-color: #f2f2ff;
        color:blue;
    }
</style>