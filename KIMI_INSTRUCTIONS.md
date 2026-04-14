# Project Guidelines: hrm_demo

## 1. Framework & Coding Style
* **Framework:** Strictly CodeIgniter 3.
* **Style & Logic:** You must carefully analyze any files I reference using the `@` symbol. Whether building a new module or modifying an existing one, replicate my exact naming conventions, variable structuring, and PHP logic.
* **UI & Appearance:** Replicate the exact HTML structure, CSS classes, and UI layout found in the views I reference.

## 2. CI3 Rules
* **Controllers:** Class and file names must start with an uppercase letter.
* **Models:** File and class names must start with `M_` (e.g., `M_note.php`). Always use CI3's Query Builder class.
* **Form & Security:** Use `$this->input->post('field', TRUE)` for XSS filtering and CI3's native form validation.

## 3. Database Handling & Dependency Tracing
* **For New Modules:** Do not guess or hallucinate database tables. You must first ask me to provide the specific database schema or tables required before you write any model code.
* **For Existing Modules (Dependency Tracing):** When I ask you to modify an existing module and reference a file using `@`, deeply analyze it. **If you notice that the file relies on other models, views, custom helpers, or libraries that I have not provided, you must explicitly tell me and ask me to provide those related files before you write any code.** Do not guess or hallucinate the contents of unreferenced files. Strictly follow the database structure already present in the models I reference.
