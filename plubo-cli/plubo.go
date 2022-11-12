package main

import (
	"embed"
	"encoding/json"
	"fmt"
	"github.com/bitfield/script"
	"github.com/fatih/color"
	"io/ioutil"
	"os"
	"path/filepath"
	"strings"
)

//go:embed functionalities/*.php
var content embed.FS

func main() {
	args, err := script.Args().Slice()

	if err != nil {
		fmt.Println(err)
	}

	if len(args) > 1 {
		switch args[0] {
		case "create":
			create(args[1])
		case "component":
			component(args[1])
		case "utils":
			utils(args[1])
		}
	} else if len(args) > 0 {
		switch args[0] {
		case "init_template":
			init_template()
		}
	} else {
		color.Cyan("\nTo the rational mind, nothing is inexplicable; only unexplained.\n\n")
	}

}

func create(functionality string) {

	exPath, _ := script.Exec("pwd").Exec("tr -d '\n'").String()
	new_text := ""

	switch functionality {
	case "admin-menus", "adminmenu", "admin-menu", "menus":
		original_text, _ := content.ReadFile("functionalities/AdminMenus.php")
		file, err := os.Create(exPath + "/Functionality/AdminMenus.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("ADMIN MENUS CLASS CREATED")
		}
		file.Close()
	case "ajax", "ajax-actions", "ajax-action":
		original_text, _ := content.ReadFile("functionalities/AjaxActions.php")
		file, err := os.Create(exPath + "/Functionality/AjaxActions.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("AJAX ACTIONS CLASS CREATED")
		}
		file.Close()
	case "api", "endpoint", "endpoints", "api-endpoint", "api-endpoints":
		original_text, _ := content.ReadFile("functionalities/ApiEndpoints.php")
		file, err := os.Create(exPath + "/Functionality/ApiEndpoints.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("API ENDPOINTS CLASS CREATED")
		}
		file.Close()
	case "cf", "fields", "field", "custom-fields", "custom-field":
		original_text, _ := content.ReadFile("functionalities/CustomFields.php")
		file, err := os.Create(exPath + "/Functionality/CustomFields.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("CUSTOM FIELDS CLASS CREATED")
		}
		file.Close()
	case "cpt", "custom-post-types", "custom-post-type", "post-type", "post-types":
		original_text, _ := content.ReadFile("functionalities/CustomPostTypes.php")
		file, err := os.Create(exPath + "/Functionality/CustomPostTypes.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("CPT CLASS CREATED")
		}
		file.Close()
	case "post-action", "post-actions", "post":
		original_text, _ := content.ReadFile("functionalities/PostActions.php")
		file, err := os.Create(exPath + "/Functionality/PostActions.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("POST ACTIONS CREATED")
		}
		file.Close()
	case "routes", "route":
		original_text, _ := content.ReadFile("functionalities/Routes.php")
		file, err := os.Create(exPath + "/Functionality/Routes.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("ROUTES CLASS CREATED")
		}
		file.Close()
	case "shortcode", "shortcodes":
		original_text, _ := content.ReadFile("functionalities/Shortcodes.php")
		file, err := os.Create(exPath + "/Functionality/Shortcodes.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("SHORTCODES CLASS CREATED")
		}
		file.Close()
	case "tax", "taxonomy", "taxonomies":
		original_text, _ := content.ReadFile("functionalities/Taxonomies.php")
		file, err := os.Create(exPath + "/Functionality/Taxonomies.php")
		new_text = namespace_file(exPath, string(original_text))
		if err != nil {
			fmt.Println(err)
		} else {
			file.WriteString(string(new_text))
			fmt.Println("TAXONOMIES CLASS CREATED")
		}
		file.Close()
	default:
		color.Cyan("\nTo the rational mind, nothing is inexplicable; only unexplained.\n\n")
	}
}

func component(name string) {
	switch name {
	case "api", "endpoint", "endpoints", "api-endpoint", "api-endpoints":
		fmt.Println("CREATE API")
	default:
		color.Cyan("\nTo the rational mind, nothing is inexplicable; only unexplained.\n\n")
	}
}

func utils(name string) {
	switch name {
	case "api", "endpoint", "endpoints", "api-endpoint", "api-endpoints":
		fmt.Println("CREATE API")
	default:
		color.Cyan("\nTo the rational mind, nothing is inexplicable; only unexplained.\n\n")
	}
}

func namespace_file(path, file_contents string) (new_text string) {
	to_replace, _ := script.Exec("basename " + path).Exec("tr -d '\n'").Exec("awk 'BEGIN{FS=\"\";RS=\"-\";ORS=\"\"} {$0=toupper(substr($0,1,1)) substr($0,2)} 1'").String()
	new_text, _ = script.Echo(string(file_contents)).Replace("PluginPlaceholder", to_replace).String()
	return
}

func namespace_project(path string) {
	to_replace, _ := script.Exec("basename " + path).Exec("tr -d '\n'").String()
	to_replace_mayus, _ := script.Exec("basename " + path).Exec("tr -d '\n'").Exec("awk 'BEGIN{FS=\"\";RS=\"-\";ORS=\"\"} {$0=toupper($0)} 1'").String()
	to_replace_pascal, _ := script.Exec("basename " + path).Exec("tr -d '\n'").Exec("awk 'BEGIN{FS=\"\";RS=\"-\";ORS=\"\"} {$0=toupper(substr($0,1,1)) substr($0,2)} 1'").String()
	os.Rename("./plugin-placeholder.php", "./"+to_replace+".php")

	err := filepath.Walk(path, func(path string, fi os.FileInfo, err error) error {

		if err != nil {
			return err
		}

		if !!fi.IsDir() {
			return nil
		}

		matched, err := filepath.Match("*.php", fi.Name())

		if err != nil {
			panic(err)
			return err
		}

		if matched {
			read, err := ioutil.ReadFile(path)
			if err != nil {
				panic(err)
			}

			newContents := strings.Replace(string(read), "plugin-placeholder", to_replace, -1)
			newContents = strings.Replace(newContents, "PLUGIN_PLACEHOLDER", to_replace_mayus, -1)
			newContents = strings.Replace(newContents, "PluginPlaceholder", to_replace_pascal, -1)

			err = ioutil.WriteFile(path, []byte(newContents), 0)
			if err != nil {
				panic(err)
			}

		}

		return nil
	})
	if err != nil {
		panic(err)
	}
	script.Exec("composer install")
	return
}

func cleanup_files() {
	os.Remove("./.github/workflows/on-template.yml")
	os.Remove("./renovate.json")
	os.Remove("./README.md")
	os.Remove("./SECURITY.md")
	os.Remove("./CONTRIBUTING.md")
	os.Remove("./CODE_OF_CONDUCT.md")
	return
}

func init_template() {
	current_repo := os.Getenv("GITHUB_REPOSITORY")
	official_repo := "joanrodas/plubo"
	exPath, _ := script.Exec("pwd").Exec("tr -d '\n'").String()

	if current_repo == official_repo {
		fmt.Println("Not using template")
		return
	}

	if current_repo == "" {
		fmt.Println("Unknown Github Repo")
		return
	}

	namespace_project(exPath)

	//COMPOSER.JSON
	composer_name := strings.ToLower(current_repo)
	composer, _ := script.File("./composer.json").String()
	var composer_json map[string]interface{}
	json.Unmarshal([]byte(composer), &composer_json)
	composer_json["name"] = composer_name
	composer_json["description"] = "An amazing plugin made with PLUBO"
	composer_data, _ := json.MarshalIndent(composer_json, "", "\t")
	script.Echo(string(composer_data)).WriteFile("composer.json")

	//PACKAGE.JSON
	package_name := ("@" + composer_name)
	pack, _ := script.File("./package.json").String()
	var package_json map[string]interface{}
	json.Unmarshal([]byte(pack), &package_json)
	package_json["name"] = package_name
	package_data, _ := json.MarshalIndent(package_json, "", "\t")
	script.Echo(string(package_data)).WriteFile("package.json")

	cleanup_files()
}
