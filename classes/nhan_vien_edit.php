<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class nhan_vien_edit extends nhan_vien
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'nhan_vien';

	// Page object name
	public $PageObjName = "nhan_vien_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (nhan_vien)
		if (!isset($GLOBALS["nhan_vien"]) || get_class($GLOBALS["nhan_vien"]) == PROJECT_NAMESPACE . "nhan_vien") {
			$GLOBALS["nhan_vien"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["nhan_vien"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'nhan_vien');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (nhan_vien)
		$UserTable = $UserTable ?: new nhan_vien();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $nhan_vien;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($nhan_vien);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "nhan_vienview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['nhan_vien_id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("nhan_vienlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("nhan_vienlist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->nhan_vien_id->Visible = FALSE;
		$this->danh_so->setVisibility();
		$this->ten_nhan_vien->setVisibility();
		$this->chuc_danh->setVisibility();
		$this->luong->Visible = FALSE;
		$this->ngay_vao_dk->Visible = FALSE;
		$this->ngay_vao_ld->Visible = FALSE;
		$this->ngayll->Visible = FALSE;
		$this->ngay_sinh->Visible = FALSE;
		$this->ncl1->Visible = FALSE;
		$this->ncl2->Visible = FALSE;
		$this->ncl3->Visible = FALSE;
		$this->DTCQ->Visible = FALSE;
		$this->DTNR->Visible = FALSE;
		$this->DTDD->Visible = FALSE;
		$this->que_quan->Visible = FALSE;
		$this->dia_chi_noi_o->Visible = FALSE;
		$this->cmnd->Visible = FALSE;
		$this->noi_cap->Visible = FALSE;
		$this->ngay_cap->Visible = FALSE;
		$this->bo_phan_id->Visible = FALSE;
		$this->username->Visible = FALSE;
		$this->password->Visible = FALSE;
		$this->_userlevel->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->danh_so->Required = FALSE;
		$this->ten_nhan_vien->Required = FALSE;

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->_userlevel);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("nhan_vienlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("nhan_vien_id") !== NULL) {
				$this->nhan_vien_id->setQueryStringValue(Get("nhan_vien_id"));
				$this->nhan_vien_id->setOldValue($this->nhan_vien_id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->nhan_vien_id->setQueryStringValue(Key(0));
				$this->nhan_vien_id->setOldValue($this->nhan_vien_id->QueryStringValue);
			} elseif (Post("nhan_vien_id") !== NULL) {
				$this->nhan_vien_id->setFormValue(Post("nhan_vien_id"));
				$this->nhan_vien_id->setOldValue($this->nhan_vien_id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->nhan_vien_id->setQueryStringValue(Route(2));
				$this->nhan_vien_id->setOldValue($this->nhan_vien_id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_nhan_vien_id")) {
					$this->nhan_vien_id->setFormValue($CurrentForm->getValue("x_nhan_vien_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("nhan_vien_id") !== NULL) {
					$this->nhan_vien_id->setQueryStringValue(Get("nhan_vien_id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->nhan_vien_id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->nhan_vien_id->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("nhan_vienlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "nhan_vienlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'danh_so' first before field var 'x_danh_so'
		$val = $CurrentForm->hasValue("danh_so") ? $CurrentForm->getValue("danh_so") : $CurrentForm->getValue("x_danh_so");
		if (!$this->danh_so->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->danh_so->Visible = FALSE; // Disable update for API request
			else
				$this->danh_so->setFormValue($val);
		}

		// Check field name 'ten_nhan_vien' first before field var 'x_ten_nhan_vien'
		$val = $CurrentForm->hasValue("ten_nhan_vien") ? $CurrentForm->getValue("ten_nhan_vien") : $CurrentForm->getValue("x_ten_nhan_vien");
		if (!$this->ten_nhan_vien->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ten_nhan_vien->Visible = FALSE; // Disable update for API request
			else
				$this->ten_nhan_vien->setFormValue($val);
		}

		// Check field name 'chuc_danh' first before field var 'x_chuc_danh'
		$val = $CurrentForm->hasValue("chuc_danh") ? $CurrentForm->getValue("chuc_danh") : $CurrentForm->getValue("x_chuc_danh");
		if (!$this->chuc_danh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->chuc_danh->Visible = FALSE; // Disable update for API request
			else
				$this->chuc_danh->setFormValue($val);
		}

		// Check field name 'userlevel' first before field var 'x__userlevel'
		$val = $CurrentForm->hasValue("userlevel") ? $CurrentForm->getValue("userlevel") : $CurrentForm->getValue("x__userlevel");
		if (!$this->_userlevel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_userlevel->Visible = FALSE; // Disable update for API request
			else
				$this->_userlevel->setFormValue($val);
		}

		// Check field name 'nhan_vien_id' first before field var 'x_nhan_vien_id'
		$val = $CurrentForm->hasValue("nhan_vien_id") ? $CurrentForm->getValue("nhan_vien_id") : $CurrentForm->getValue("x_nhan_vien_id");
		if (!$this->nhan_vien_id->IsDetailKey)
			$this->nhan_vien_id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nhan_vien_id->CurrentValue = $this->nhan_vien_id->FormValue;
		$this->danh_so->CurrentValue = $this->danh_so->FormValue;
		$this->ten_nhan_vien->CurrentValue = $this->ten_nhan_vien->FormValue;
		$this->chuc_danh->CurrentValue = $this->chuc_danh->FormValue;
		$this->_userlevel->CurrentValue = $this->_userlevel->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('edit');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->nhan_vien_id->setDbValue($row['nhan_vien_id']);
		$this->danh_so->setDbValue($row['danh_so']);
		$this->ten_nhan_vien->setDbValue($row['ten_nhan_vien']);
		$this->chuc_danh->setDbValue($row['chuc_danh']);
		$this->luong->setDbValue($row['luong']);
		$this->ngay_vao_dk->setDbValue($row['ngay_vao_dk']);
		$this->ngay_vao_ld->setDbValue($row['ngay_vao_ld']);
		$this->ngayll->setDbValue($row['ngayll']);
		$this->ngay_sinh->setDbValue($row['ngay_sinh']);
		$this->ncl1->setDbValue($row['ncl1']);
		$this->ncl2->setDbValue($row['ncl2']);
		$this->ncl3->setDbValue($row['ncl3']);
		$this->DTCQ->setDbValue($row['DTCQ']);
		$this->DTNR->setDbValue($row['DTNR']);
		$this->DTDD->setDbValue($row['DTDD']);
		$this->que_quan->setDbValue($row['que_quan']);
		$this->dia_chi_noi_o->setDbValue($row['dia_chi_noi_o']);
		$this->cmnd->setDbValue($row['cmnd']);
		$this->noi_cap->setDbValue($row['noi_cap']);
		$this->ngay_cap->setDbValue($row['ngay_cap']);
		$this->bo_phan_id->setDbValue($row['bo_phan_id']);
		$this->username->setDbValue($row['username']);
		$this->password->setDbValue($row['password']);
		$this->_userlevel->setDbValue($row['userlevel']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['nhan_vien_id'] = NULL;
		$row['danh_so'] = NULL;
		$row['ten_nhan_vien'] = NULL;
		$row['chuc_danh'] = NULL;
		$row['luong'] = NULL;
		$row['ngay_vao_dk'] = NULL;
		$row['ngay_vao_ld'] = NULL;
		$row['ngayll'] = NULL;
		$row['ngay_sinh'] = NULL;
		$row['ncl1'] = NULL;
		$row['ncl2'] = NULL;
		$row['ncl3'] = NULL;
		$row['DTCQ'] = NULL;
		$row['DTNR'] = NULL;
		$row['DTDD'] = NULL;
		$row['que_quan'] = NULL;
		$row['dia_chi_noi_o'] = NULL;
		$row['cmnd'] = NULL;
		$row['noi_cap'] = NULL;
		$row['ngay_cap'] = NULL;
		$row['bo_phan_id'] = NULL;
		$row['username'] = NULL;
		$row['password'] = NULL;
		$row['userlevel'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("nhan_vien_id")) != "")
			$this->nhan_vien_id->OldValue = $this->getKey("nhan_vien_id"); // nhan_vien_id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// nhan_vien_id
		// danh_so
		// ten_nhan_vien
		// chuc_danh
		// luong
		// ngay_vao_dk
		// ngay_vao_ld
		// ngayll
		// ngay_sinh
		// ncl1
		// ncl2
		// ncl3
		// DTCQ
		// DTNR
		// DTDD
		// que_quan
		// dia_chi_noi_o
		// cmnd
		// noi_cap
		// ngay_cap
		// bo_phan_id
		// username
		// password
		// userlevel

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// nhan_vien_id
			$this->nhan_vien_id->ViewValue = FormatNumber($this->nhan_vien_id->ViewValue, 0, -2, -2, -2);
			$this->nhan_vien_id->ViewCustomAttributes = "";

			// danh_so
			$this->danh_so->ViewValue = $this->danh_so->CurrentValue;
			$this->danh_so->ViewCustomAttributes = "";

			// ten_nhan_vien
			$this->ten_nhan_vien->ViewValue = $this->ten_nhan_vien->CurrentValue;
			$this->ten_nhan_vien->ViewCustomAttributes = "";

			// chuc_danh
			$this->chuc_danh->ViewValue = $this->chuc_danh->CurrentValue;
			$this->chuc_danh->ViewCustomAttributes = "";

			// luong
			$this->luong->ViewValue = $this->luong->CurrentValue;
			$this->luong->ViewValue = FormatNumber($this->luong->ViewValue, 0, -2, -2, -2);
			$this->luong->ViewCustomAttributes = "";

			// ngay_vao_dk
			$this->ngay_vao_dk->ViewValue = $this->ngay_vao_dk->CurrentValue;
			$this->ngay_vao_dk->ViewValue = FormatDateTime($this->ngay_vao_dk->ViewValue, 0);
			$this->ngay_vao_dk->ViewCustomAttributes = "";

			// ngay_vao_ld
			$this->ngay_vao_ld->ViewValue = $this->ngay_vao_ld->CurrentValue;
			$this->ngay_vao_ld->ViewValue = FormatDateTime($this->ngay_vao_ld->ViewValue, 0);
			$this->ngay_vao_ld->ViewCustomAttributes = "";

			// ngayll
			$this->ngayll->ViewValue = $this->ngayll->CurrentValue;
			$this->ngayll->ViewValue = FormatDateTime($this->ngayll->ViewValue, 0);
			$this->ngayll->ViewCustomAttributes = "";

			// ngay_sinh
			$this->ngay_sinh->ViewValue = $this->ngay_sinh->CurrentValue;
			$this->ngay_sinh->ViewValue = FormatDateTime($this->ngay_sinh->ViewValue, 0);
			$this->ngay_sinh->ViewCustomAttributes = "";

			// ncl1
			$this->ncl1->ViewValue = $this->ncl1->CurrentValue;
			$this->ncl1->ViewValue = FormatDateTime($this->ncl1->ViewValue, 0);
			$this->ncl1->ViewCustomAttributes = "";

			// ncl2
			$this->ncl2->ViewValue = $this->ncl2->CurrentValue;
			$this->ncl2->ViewValue = FormatDateTime($this->ncl2->ViewValue, 0);
			$this->ncl2->ViewCustomAttributes = "";

			// ncl3
			$this->ncl3->ViewValue = $this->ncl3->CurrentValue;
			$this->ncl3->ViewValue = FormatDateTime($this->ncl3->ViewValue, 0);
			$this->ncl3->ViewCustomAttributes = "";

			// DTCQ
			$this->DTCQ->ViewValue = $this->DTCQ->CurrentValue;
			$this->DTCQ->ViewCustomAttributes = "";

			// DTNR
			$this->DTNR->ViewValue = $this->DTNR->CurrentValue;
			$this->DTNR->ViewCustomAttributes = "";

			// DTDD
			$this->DTDD->ViewValue = $this->DTDD->CurrentValue;
			$this->DTDD->ViewCustomAttributes = "";

			// que_quan
			$this->que_quan->ViewValue = $this->que_quan->CurrentValue;
			$this->que_quan->ViewCustomAttributes = "";

			// dia_chi_noi_o
			$this->dia_chi_noi_o->ViewValue = $this->dia_chi_noi_o->CurrentValue;
			$this->dia_chi_noi_o->ViewCustomAttributes = "";

			// cmnd
			$this->cmnd->ViewValue = $this->cmnd->CurrentValue;
			$this->cmnd->ViewCustomAttributes = "";

			// noi_cap
			$this->noi_cap->ViewValue = $this->noi_cap->CurrentValue;
			$this->noi_cap->ViewCustomAttributes = "";

			// ngay_cap
			$this->ngay_cap->ViewValue = $this->ngay_cap->CurrentValue;
			$this->ngay_cap->ViewValue = FormatDateTime($this->ngay_cap->ViewValue, 0);
			$this->ngay_cap->ViewCustomAttributes = "";

			// bo_phan_id
			$this->bo_phan_id->ViewValue = $this->bo_phan_id->CurrentValue;
			$this->bo_phan_id->ViewValue = FormatNumber($this->bo_phan_id->ViewValue, 0, -2, -2, -2);
			$this->bo_phan_id->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->ViewCustomAttributes = "";

			// password
			$this->password->ViewValue = $this->password->CurrentValue;
			$this->password->ViewCustomAttributes = "";

			// userlevel
			if ($Security->canAdmin()) { // System admin
				$curVal = strval($this->_userlevel->CurrentValue);
				if ($curVal != "") {
					$this->_userlevel->ViewValue = $this->_userlevel->lookupCacheOption($curVal);
					if ($this->_userlevel->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->_userlevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->_userlevel->ViewValue = $this->_userlevel->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->_userlevel->ViewValue = $this->_userlevel->CurrentValue;
						}
					}
				} else {
					$this->_userlevel->ViewValue = NULL;
				}
			} else {
				$this->_userlevel->ViewValue = $Language->phrase("PasswordMask");
			}
			$this->_userlevel->ViewCustomAttributes = "";

			// danh_so
			$this->danh_so->LinkCustomAttributes = "";
			$this->danh_so->HrefValue = "";
			$this->danh_so->TooltipValue = "";

			// ten_nhan_vien
			$this->ten_nhan_vien->LinkCustomAttributes = "";
			$this->ten_nhan_vien->HrefValue = "";
			$this->ten_nhan_vien->TooltipValue = "";

			// chuc_danh
			$this->chuc_danh->LinkCustomAttributes = "";
			$this->chuc_danh->HrefValue = "";
			$this->chuc_danh->TooltipValue = "";

			// userlevel
			$this->_userlevel->LinkCustomAttributes = "";
			$this->_userlevel->HrefValue = "";
			$this->_userlevel->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// danh_so
			$this->danh_so->EditAttrs["class"] = "form-control";
			$this->danh_so->EditCustomAttributes = "";
			$this->danh_so->EditValue = $this->danh_so->CurrentValue;
			$this->danh_so->ViewCustomAttributes = "";

			// ten_nhan_vien
			$this->ten_nhan_vien->EditAttrs["class"] = "form-control";
			$this->ten_nhan_vien->EditCustomAttributes = "";
			$this->ten_nhan_vien->EditValue = $this->ten_nhan_vien->CurrentValue;
			$this->ten_nhan_vien->ViewCustomAttributes = "";

			// chuc_danh
			$this->chuc_danh->EditAttrs["class"] = "form-control";
			$this->chuc_danh->EditCustomAttributes = "";
			if (!$this->chuc_danh->Raw)
				$this->chuc_danh->CurrentValue = HtmlDecode($this->chuc_danh->CurrentValue);
			$this->chuc_danh->EditValue = HtmlEncode($this->chuc_danh->CurrentValue);
			$this->chuc_danh->PlaceHolder = RemoveHtml($this->chuc_danh->caption());

			// userlevel
			$this->_userlevel->EditAttrs["class"] = "form-control";
			$this->_userlevel->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->_userlevel->EditValue = $Language->phrase("PasswordMask");
			} else {
				$curVal = trim(strval($this->_userlevel->CurrentValue));
				if ($curVal != "")
					$this->_userlevel->ViewValue = $this->_userlevel->lookupCacheOption($curVal);
				else
					$this->_userlevel->ViewValue = $this->_userlevel->Lookup !== NULL && is_array($this->_userlevel->Lookup->Options) ? $curVal : NULL;
				if ($this->_userlevel->ViewValue !== NULL) { // Load from cache
					$this->_userlevel->EditValue = array_values($this->_userlevel->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`userlevelid`" . SearchString("=", $this->_userlevel->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->_userlevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->_userlevel->EditValue = $arwrk;
				}
			}

			// Edit refer script
			// danh_so

			$this->danh_so->LinkCustomAttributes = "";
			$this->danh_so->HrefValue = "";
			$this->danh_so->TooltipValue = "";

			// ten_nhan_vien
			$this->ten_nhan_vien->LinkCustomAttributes = "";
			$this->ten_nhan_vien->HrefValue = "";
			$this->ten_nhan_vien->TooltipValue = "";

			// chuc_danh
			$this->chuc_danh->LinkCustomAttributes = "";
			$this->chuc_danh->HrefValue = "";

			// userlevel
			$this->_userlevel->LinkCustomAttributes = "";
			$this->_userlevel->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->danh_so->Required) {
			if (!$this->danh_so->IsDetailKey && $this->danh_so->FormValue != NULL && $this->danh_so->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->danh_so->caption(), $this->danh_so->RequiredErrorMessage));
			}
		}
		if ($this->ten_nhan_vien->Required) {
			if (!$this->ten_nhan_vien->IsDetailKey && $this->ten_nhan_vien->FormValue != NULL && $this->ten_nhan_vien->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ten_nhan_vien->caption(), $this->ten_nhan_vien->RequiredErrorMessage));
			}
		}
		if ($this->chuc_danh->Required) {
			if (!$this->chuc_danh->IsDetailKey && $this->chuc_danh->FormValue != NULL && $this->chuc_danh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->chuc_danh->caption(), $this->chuc_danh->RequiredErrorMessage));
			}
		}
		if ($this->_userlevel->Required) {
			if (!$this->_userlevel->IsDetailKey && $this->_userlevel->FormValue != NULL && $this->_userlevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_userlevel->caption(), $this->_userlevel->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// chuc_danh
			$this->chuc_danh->setDbValueDef($rsnew, $this->chuc_danh->CurrentValue, NULL, $this->chuc_danh->ReadOnly);

			// userlevel
			
			if ($Security->canAdmin()) { // System admin
				
				$this->_userlevel->setDbValueDef($rsnew, $this->_userlevel->CurrentValue, 0, $this->_userlevel->ReadOnly);
				
			}
			

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->nhan_vien_id->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("nhan_vienlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x__userlevel":
					$conn = Conn("DB");
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x__userlevel":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>