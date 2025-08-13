<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maple Salon | Registration</title>
    <style>
        /* Elegant Salon Style */
        :root {
            --primary: #a8277f; /* Rich purple */
            --secondary: #D1B3C4; /* Soft mauve */
            --accent: #F7D1CD; /* Blush pink */
            --light: #F8F4F9; /* Light lavender */
            --dark: #392F5A; /* Deep indigo */
            --text: #333333; 
            --success: #7FB685; /* Soft green */
            --error: #E56B6F; /* Coral */
            --gold: #D4A76A; /* Accent gold */
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Montserrat', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            background-color: var(--light);
            color: var(--text);
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://images.unsplash.com/photo-1519735777090-ec97162dc266?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .container {
            max-width: 750px;
            width: 100%;
            margin: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
        }
        
        h1 {
            text-align: center;
            color: var(--dark);
            margin-bottom: 30px;
            font-size: 2.2rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--gold));
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            height: 60px;
            margin-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.95rem;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            z-index: 1;
        }
        
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"],
        input[type="time"],
        input[type="date"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 14px 18px 14px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.8);
            color: var(--text);
        }
        
        select {
            padding-left: 45px;
            background-position: right 15px center;
        }
        
        textarea {
            padding-left: 45px;
            min-height: 100px;
        }
        
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 95, 191, 0.2);
            background-color: white;
        }
        
        .radio-group {
            display: flex;
            gap: 25px;
            margin-top: 8px;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
        }
        
        .radio-option input {
            margin-right: 10px;
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
        }
        
        .service-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 12px;
            margin-top: 8px;
        }
        
        .checkbox-option {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .checkbox-option:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .checkbox-option input {
            margin-right: 10px;
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
        }
        
        button {
            background: linear-gradient(to right, var(--primary), var(--dark));
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 16px;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            margin-top: 25px;
            transition: all 0.3s;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        
        button:hover {
            background-color: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 95, 191, 0.3);
        }
        
        button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        button:hover::after {
            left: 100%;
        }
        
        .error {
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 6px;
            display: none;
            font-weight: 500;
        }
        
        .success-message {
            display: none;
            background: linear-gradient(to right, var(--success), #8FCB9B);
            color: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Image upload styling */
        .image-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 25px;
            border: 2px dashed var(--secondary);
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .image-upload:hover {
            border-color: var(--primary);
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        .image-upload i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 12px;
        }
        
        .image-upload p {
            margin: 0;
            color: var(--text);
            text-align: center;
            font-weight: 500;
        }
        
        .image-upload small {
            color: #777;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .image-preview {
            display: none;
            margin-top: 15px;
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            object-fit: contain;
        }
        
        /* Select dropdown styling */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235d4e60' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 30px;
            }
            
            .service-options {
                grid-template-columns: 1fr 1fr;
            }
            
            h1 {
                font-size: 1.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 25px 20px;
            }
            
            h1 {
                font-size: 1.7rem;
            }
            
            .service-options {
                grid-template-columns: 1fr;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 12px;
            }
            
            input, select, textarea {
                padding: 12px 15px 12px 40px;
            }
            
            .input-icon {
                left: 12px;
                font-size: 0.9rem;
            }
        }

        /* Animation for success message */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .success-message {
            animation: fadeIn 0.4s ease-out;
        }
        
        /* Floating labels effect */
        .form-group.focused label {
            color: var(--primary);
        }
        
        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 40px;
            cursor: pointer;
            color: var(--secondary);
        }
        
        .password-toggle:hover {
            color: var(--primary);
        }
        
        /* Toggle button styling */
        .toggle-btn {
            padding: 12px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            width: 100%;
        }
        
        .toggle-btn:hover {
            background-color: var(--dark);
            transform: translateY(-2px);
        }
        
        .toggle-btn i {
            transition: transform 0.3s;
        }
        
        .toggle-btn.active i {
            transform: rotate(180deg);
        }
        
        /* Service options container */
        .service-options-container {
            margin-top: 15px;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        
        /* Service option icons */
        .service-icon {
            margin-right: 10px;
            color: var(--primary);
        }

        /* Image preview container */
        .image-preview-container {
            position: relative;
            display: none;
            margin-top: 15px;
        }

        .remove-image-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--error);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 2;
        }

        .remove-image-btn:hover {
            background-color: #d45458;
        }

        /* Toggle form trigger styling */
        .toggle-form-trigger {
            cursor: pointer;
            padding: 10px;
            background: #f0f0f0;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .toggle-form-trigger:hover {
            background: #e0e0e0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1><i class="fas fa-spa" style="color: var(--primary); margin-right: 10px;"></i>Maple Salon</h1>
        </div>
        
     <form action="{{ route('store.register') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
    @csrf
    <input type="hidden" name="status" value="processing">
    
    <div class="form-group">
        <label for="name">ឈ្មោះ*</label>
        <div class="input-with-icon">
            <i class="fas fa-user input-icon"></i>
            <input type="text" id="name" name="name" required placeholder="បញ្ចូលឈ្មោះរបស់អ្នក">
        </div>
        <div id="nameError" class="error">សូមបញ្ចូលឈ្មោះរបស់អ្នក</div>
    </div>
    
    <div class="form-group">
        <label for="phone">លេខទូរស័ព្ទ*</label>
        <div class="input-with-icon">
            <i class="fas fa-phone-alt input-icon"></i>
            <input type="tel" id="phone" name="phone" required placeholder="បញ្ចូលលេខទូរស័ព្ទរបស់អ្នក">
        </div>
        <div id="phoneError" class="error">សូមបញ្ចូលលេខទូរស័ព្ទរបស់អ្នក</div>
    </div>
  
    <div class="form-group">
        <label>ជ្រើសរើសសេវាកម្មដែលអ្នកចង់ធ្វើ្ត*</label>
        <button type="button" onclick="toggleServices()" class="toggle-btn" id="servicesToggle">
            <i class="fas fa-chevron-down"></i> ជ្រើសរើសសេវាកម្ម
        </button>

        <div class="service-options-container" id="serviceOptions" style="display: none;">
            <div class="service-options">
                @foreach($services as $service)
                <label class="checkbox-option">
                    <input type="checkbox" name="service_id[]" value="{{ $service->id }}">
                    @if(str_contains(strtolower($service->name), 'haircut') || str_contains(strtolower($service->name), 'hair cut'))
                        <i class="fas fa-cut service-icon" title="Haircut"></i>
                    @elseif(str_contains(strtolower($service->name), 'color') || str_contains(strtolower($service->name), 'dye'))
                        <i class="fas fa-paint-brush service-icon" title="Coloring"></i>
                    @else
                        <i class="fas fa-spa service-icon" title="Service"></i>
                    @endif
                    {{ $service->name }}
                </label>
                @endforeach            
            </div>
        </div>
        <div id="serviceError" class="error">សូមជ្រើសរើសសេវាកម្មយាងហោចណាស់មួយ</div>
    </div>
    
    <div class="form-group">
        <label for="date">កាលបរិច្ឆេទកក់*</label>
        <div class="input-with-icon">
            <i class="far fa-calendar-alt input-icon"></i>
            <input type="date" id="date" name="booking_date" required min="{{ date('Y-m-d') }}">
        </div>
        <div id="dateError" class="error">សូមជ្រើសរើសកាលបរិច្ឆេទត្រឹមត្រូវ</div>
    </div>

    <div class="form-group">
        <label for="time">ពេលវេលា/ម៉ោងកក់*</label>
        <div class="input-with-icon">
            <i class="far fa-clock input-icon"></i>
            <input type="time" id="time" name="booking_time" required>
        </div>
        <div id="timeError" class="error">សូមជ្រើសរើសម៉ោងកក់</div>
    </div>

    <div class="form-group floating-label">
        <label>ជ្រើសរើសទីតាំងដែលនៅជិតលោកអ្នក*<span class="required">*</span></label>
        <div class="input-with-icon">
            <i class="fas fa-store input-icon"></i>
            <select name="branch_id" class="form-control" required>
                <option value="">ជ្រើសរើសទីតាំង</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="branchError" class="error">សូមជ្រើសរើសសាខាដែលអ្នកពេញចិត្ត</div>
    </div>
   
   

    <div class="toggle-form-trigger" id="toggleFormTrigger">
        <p>Click ត្រង់នេះ ប្រសិនបើអ្នកចង់បង្ហោះសំណើបន្ថែមរបស់អ្នក</p>
    </div>

    <div id="hiddenFormContainer" style="display: none;">
        <div class="form-group">
            <label for="image">ផ្ញើរូបភាព(Model) ដែលអ្នក​ចង់ធ្វើ</label>
            <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">
            <div class="image-upload" id="imageUpload">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>ចុចដើម្បីបង្ហោះរូបភាព</p>
                <small>JPG, PNG, or GIF - Max 5MB</small>
            </div>
            <div class="image-preview-container" id="imagePreviewContainer">
                <img id="imagePreview" class="image-preview" alt="Image preview">
                <button type="button" class="remove-image-btn" id="removeImageBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="imageError" class="error"></div>
        </div>

        <div class="form-group">
            <label for="note"> សំណើពិសេស ឬកំណត់ចំណាំ</label>
            <div class="input-with-icon">
                <i class="fas fa-edit input-icon" style="top: 20px;"></i>
                <textarea id="note" name="note" rows="3" placeholder="សំណើពិសេស/កំណត់ចំណាំសម្រាប់អ្នករចនាម៉ូដរបស់យើង"></textarea>
            </div>
        </div>
    </div>       
    
    <button type="submit">
        <i class="fas fa-calendar-check"></i> ចាប់ផ្តើមកក់
    </button>
</form>
        
        <div id="successMessage" class="success-message">
            <h3><i class="fas fa-check-circle"></i> Welcome to Maple Salon!</h3>
            <p>Your appointment request has been received. We'll confirm your booking shortly.</p>
            <p>Check your email for confirmation details!</p>
        </div>
        
        <div class="form-footer">
            <p>សម្រាប់ព័តមានបន្ថែម ​​​​​​​​​​​សូមទាក់ទងមកយើងខ្ញុំ <a href="tel:070604747" style="color: var(--primary); font-weight: 600;"><i class="fas fa-sign-in-alt"></i> 070604747</a></p>
        </div>
    </div>

    <script>
        // Toggle additional form fields
        document.getElementById('toggleFormTrigger').addEventListener('click', function() {
            const formContainer = document.getElementById('hiddenFormContainer');
            if (formContainer.style.display === 'none') {
                formContainer.style.display = 'block';
                this.querySelector('p').textContent = 'បិទប្រអប់នេះ';
            } else {
                formContainer.style.display = 'none';
                this.querySelector('p').textContent = 'Click ត្រង់នេះ ប្រសិនបើអ្នកចង់បង្ហោះសំណើបន្ថែមរបស់អ្នក'; 
            }
        });

        // Toggle services dropdown
        function toggleServices() {
            const serviceOptions = document.getElementById('serviceOptions');
            const toggleBtn = document.getElementById('servicesToggle');
            
            if (serviceOptions.style.display === 'none') {
                serviceOptions.style.display = 'block';
                toggleBtn.classList.add('active');
                toggleBtn.innerHTML = '<i class="fas fa-chevron-up"></i> លាក់សេវាកម្ម';
            } else {
                serviceOptions.style.display = 'none';
                toggleBtn.classList.remove('active');
                toggleBtn.innerHTML = '<i class="fas fa-chevron-down"></i> ជ្រើសរើសសេវាកម្ម';
            }
        }

        // Image upload functionality
        const imageUpload = document.getElementById('imageUpload');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const removeImageBtn = document.getElementById('removeImageBtn');

        imageUpload.addEventListener('click', () => {
            imageInput.click();
        });

        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });

        removeImageBtn.addEventListener('click', function() {
            imagePreview.src = '';
            imageInput.value = '';
            imagePreviewContainer.style.display = 'none';
        });

        // Form validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate name
            const name = document.getElementById('name').value.trim();
            if (name === '') {
                document.getElementById('nameError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('nameError').style.display = 'none';
            }
            
            // Validate phone
            const phone = document.getElementById('phone').value.trim();
            if (phone === '') {
                document.getElementById('phoneError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('phoneError').style.display = 'none';
            }
            
            // Validate at least one service is selected
            const services = document.querySelectorAll('input[name="service_id[]"]:checked');
            if (services.length === 0) {
                document.getElementById('serviceError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('serviceError').style.display = 'none';
            }
            
            // Validate date
            const date = document.getElementById('date').value;
            if (date === '') {
                document.getElementById('dateError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('dateError').style.display = 'none';
            }
            
            // Validate time
            const time = document.getElementById('time').value;
            if (time === '') {
                document.getElementById('timeError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('timeError').style.display = 'none';
            }
            
            // Validate branch
            const branch = document.querySelector('select[name="branch_id"]').value;
            if (branch === '') {
                document.getElementById('branchError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('branchError').style.display = 'none';
            }
            
            if (!isValid) {
                e.preventDefault();
            } else {
                // Show success message (for demo purposes)
                e.preventDefault();
                document.getElementById('registrationForm').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block';
                
                // In a real application, you would submit the form here
                // this.submit();
            }
        });
    </script>
</body>
</html>