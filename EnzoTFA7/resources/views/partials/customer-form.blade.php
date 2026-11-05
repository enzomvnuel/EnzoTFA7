<div class="field">
    <label for="full_name">Full name</label>
    <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $customer->full_name ?? '') }}" required>
    @error('full_name') <small class="field-error">{{ $message }}</small> @enderror
</div>
<div class="field">
    <label for="email">Email address</label>
    <input id="email" name="email" type="email" value="{{ old('email', $customer->email ?? '') }}" required>
    @error('email') <small class="field-error">{{ $message }}</small> @enderror
</div>
<div class="field">
    <label for="phone">Phone <span class="optional">Optional</span></label>
    <input id="phone" name="phone" type="text" value="{{ old('phone', $customer->phone ?? '') }}">
    @error('phone') <small class="field-error">{{ $message }}</small> @enderror
</div>
