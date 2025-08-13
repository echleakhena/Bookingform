<div class="salon-background">
    <div class="booking-container">
        <div class="card glass-card">
            @if(session('success'))
                <!-- Success Message Section -->
                <div class="success-container">
                    <div class="success-card">
                        <div class="success-icon">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/>
                            </svg>
                        </div>
                        <h3>Successfully!</h3>
                        <p class="success-message">សំណើរកក់សេវាកម្ម​​ របស់លោកអ្នកត្រូវបានទទួល។ អរគុណសម្រាប់ការកក់ទុក។ </p>
                        
                        <div class="contact-info">
                            <p>សម្រាប់ព័តមានបន្ថែម សូមទាក់ទងមកយើងខ្ញុំ</p>
                            <a href="tel:070604747" class="contact-phone">
                                <i class="fas fa-phone-alt"></i> 070 604 747
                            </a>
                        </div>
                        
                        <div class="success-decoration">
                            <div class="deco-line"></div>
                            <i class="fas fa-spa deco-icon"></i>
                            <div class="deco-line"></div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Booking Form Section -->
                <div class="card-header">
                    <h2><i class="fas fa-calendar-edit mr-2"></i>Book Your Appointment</h2>
                    <p class="salon-slogan">Welcome to Maple Salon — Today is {{ \Carbon\Carbon::now()->format('d.m.Y') }}</p>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('store.booking') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-column">
                            <!-- Name Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="fas fa-user icon-left"></i>
                                <input type="text" id="name" name="name" class="form-control" placeholder="សូមបញ្ចូលឈ្មោះរបស់អ្នក" required>
                                <label for="name">ឈ្មោះ</label>
                            </div>
                            
                            <!-- Phone Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="fas fa-phone-alt icon-left"></i>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="សូមបញ្ចូលលេខទូរស័ព្ទរបស់អ្នក" required>
                                <label for="phone">លេខទូរស័ព្ទ</label>
                            </div>
                            
                            <!-- Branch Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="fas fa-map-marker-alt icon-left"></i>
                                <select name="branch_id" id="branch" class="form-control" required>
                                    <option value="">ជ្រើសរើសទីតាំង</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                <label for="branch">ទីតាំងសាឡន</label>
                            </div>
                            
                            <!-- Service Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="fas fa-cut icon-left"></i>
                                <select name="service_id" id="service" class="form-control" required>
                                    <option value="">ជ្រើសរើសសេវាកម្ម</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                <label for="service">សេវាកម្ម</label>
                            </div>
                            
                            <!-- Date Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="far fa-calendar-alt icon-left"></i>
                                <input type="date" id="date" name="booking_date" class="form-control" required min="{{ date('Y-m-d') }}">
                                <label for="date">កាលបរិច្ឆេទកក់ <span class="required">*</span></label>
                            </div>
                            
                            <!-- Time Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="far fa-clock icon-left"></i>
                                <select id="time" name="booking_time" class="form-control" required>
                                    <option value="">ជ្រើសរើសម៉ោង</option>
                                    <option value="08:00">8:00 AM</option>
                                    <option value="09:00">9:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="13:00">1:00 PM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                    <option value="17:00">5:00 PM</option>
                                    <option value="18:00">6:00 PM</option>
                                    <option value="19:00">7:00 PM</option>
                                </select>
                                <label for="time">ម៉ោងកក់ <span class="required">*</span></label>
                            </div>
                            
                            <!-- Notes Field with Icon -->
                            <div class="form-group floating-label with-icon">
                                <i class="fas fa-edit icon-left"></i>
                                <textarea id="note" name="note" rows="3" class="form-control" placeholder=" "></textarea>
                                <label for="note">សំណើពិសេស ឬកំណត់ចំណាំ</label>
                            </div>
                            
                            <!-- Image Upload -->
                            <div class="form-group">
                                <div class="image-upload-container">
                                    <label class="image-upload-label">
                                        <i class="fas fa-camera mr-2"></i>ផ្ញើរូបភាព(Model) ដែលអ្នកចង់ធ្វើ
                                    </label>
                                    <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">
                                    <div class="image-upload-area" id="imageUpload" onclick="document.getElementById('imageInput').click()">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p>Upload style inspiration</p>
                                        <small>JPG, PNG, or GIF - Max 5MB</small>
                                    </div>
                                    <div id="imagePreview" style="display: none; margin-top: 10px;">
                                        <img id="previewImage" src="#" alt="Preview" class="preview-image">
                                        <button type="button" class="remove-image-btn" onclick="removeImage()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="reset" class="btn btn-outline">
                                    <i class="fas fa-times"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary btn-animate">
                                    <i class="fas fa-calendar-check"></i> Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Image Upload Preview
    document.getElementById('imageInput')?.addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const uploadArea = document.getElementById('imageUpload');
        
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                preview.style.display = 'block';
                uploadArea.style.display = 'none';
            }
            
            reader.readAsDataURL(file);
        }
    });
    
    function removeImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('imageUpload').style.display = 'block';
    }
    
    // Set minimum date to today
    document.getElementById('date')?.min = new Date().toISOString().split("T")[0];
</script>

<style>
    /* CSS Variables */
    :root {
        --primary: #9b1787;
        --primary-light: #d578c9;
        --primary-dark: #7a0c63;
        --secondary: #ff9e00;
        --error: #ff4444;
        --success: #00c851;
        --dark: #3a0a3a;
        --light: #611255;
        --gray: #adb5bd;
        --border-radius: 12px;
        --box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    /* Base Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }
    
    .salon-background {
        background: url('') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .booking-container {
        max-width: 800px;
        width: 100%;
        margin: 0 auto;
    }
    
    /* Card Styles */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }
    
    .card-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
    }
    
    .card-header h2 {
        margin: 0;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
    }
    
    .salon-slogan {
        color: var(--primary-light);
        font-style: italic;
        margin: 5px 0 0;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    /* Form Elements with Icons */
    .form-group.with-icon {
        position: relative;
    }
    
    .icon-left {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary);
        z-index: 2;
    }
    
    .form-group.with-icon .form-control,
    .form-group.with-icon select.form-control {
        padding-left: 45px;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .floating-label {
        position: relative;
    }
    
    .floating-label label {
        position: absolute;
        top: 16px;
        left: 45px;
        color: var(--gray);
        transition: var(--transition);
        background: white;
        padding: 0 5px;
        transform-origin: left top;
    }
    
    .form-control:focus ~ label,
    .form-control:not(:placeholder-shown) ~ label,
    select.form-control:focus ~ label,
    select.form-control:valid ~ label {
        transform: translateY(-24px) scale(0.85);
        color: var(--primary);
        left: 30px;
    }
    
    .form-control {
        width: 100%;
        padding: 16px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        transition: var(--transition);
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(155, 23, 135, 0.1);
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%239b1787' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
    }
    
    .required {
        color: var(--error);
    }
    
    /* Image Upload */
    .image-upload-area {
        border: 2px dashed #e0e0e0;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .image-upload-area:hover {
        border-color: var(--primary);
    }
    
    .preview-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
    }
    
    .remove-image-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: var(--error);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Buttons */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-dark);
    }
    
    .btn-outline {
        background-color: transparent;
        color: var(--primary);
        border: 1px solid var(--primary);
    }
    
    /* Success Message */
    .success-container {
        padding: 2rem;
    }
    
    .success-card {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(155, 23, 135, 0.15);
        position: relative;
    }
    
    .success-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 200, 81, 0.1);
        border-radius: 50%;
        color: #00c851;
    }
    
    .contact-phone {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(155, 23, 135, 0.1);
        color: #9b1787;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
    }
    
    /* Responsive */
    @media (max-width: 576px) {
        .salon-background {
            padding: 20px 10px;
        }
        
        .form-actions {
            flex-direction: column-reverse;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>