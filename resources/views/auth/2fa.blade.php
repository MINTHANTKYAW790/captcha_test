<x-guest-layout>
    <form method="POST" action="{{ route('2fa.verify') }}" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        @csrf
        <h2 style="text-align: center; margin-bottom: 20px;">Two-Factor Authentication</h2>
        
        <div style="margin-bottom: 15px;">
            <label for="code" style="display: block; font-weight: bold; margin-bottom: 5px;">Enter 6-digit code:</label>
            <input 
                type="text" 
                name="code" 
                id="code" 
                required 
                autofocus 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"
                placeholder="123456"
            >
        </div>

        @error('code')
            <div style="color: red; margin-bottom: 15px;">{{ $message }}</div>
        @enderror

        <button 
            type="submit" 
            style="width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;"
        >
            Verify
        </button>
    </form>
</x-guest-layout>
