<div class="field">
    <label for="username">Username</label>
    <input id="username" name="username" type="text" value="{{ old('username', $user->username ?? '') }}" required>
    @error('username') <small class="field-error">{{ $message }}</small> @enderror
</div>
<div class="field">
    <label for="full_name">Full name</label>
    <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $user->full_name ?? '') }}" required>
    @error('full_name') <small class="field-error">{{ $message }}</small> @enderror
</div>
