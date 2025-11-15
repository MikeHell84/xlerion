<div style="font-family: Arial, Helvetica, sans-serif; color:#111;">
    <h2>Nuevo mensaje desde el sitio</h2>
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <div style="border-left:4px solid #ddd; padding-left:12px; color:#333;">{{ nl2br(e($data['message'])) }}</div>
</div>
